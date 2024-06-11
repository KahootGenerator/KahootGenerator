<?php

namespace App\Controllers;

use App\Database\Managers\AnswerManager;
use App\Database\Managers\DifficultyManager;
use App\Database\Managers\LanguageManager;
use App\Database\Managers\QuestionManager;
use App\Validator;
use App\Database\Managers\KahootManager;
use App\Core\Controller;
use App\Helper;
use Shuchkin\SimpleXLSXGen;

final class KahootController extends Controller
{
    protected Validator $validator;
    protected KahootManager $kahootManager;
    public function __construct()
    {
        $this->validator = new Validator();
        $this->kahootManager = new KahootManager();
    }
    public function generate(): void
    {
        //If user is signed in
        if (isset($_SESSION['user'])) {
            //Validate the fields
            $this->validator->validate([
                "theme" => ["required", "alphaSpace"],
                "quantity" => ["required", "numeric"],
                "lang" => ["required", "numeric"],
                "diff" => ["required", "numeric"]
            ]);
            $_SESSION["old"] = $_POST;

            if (!$this->validator->errors()) {
                //Search the difficulty and the language in the database
                $dm = new DifficultyManager();
                $diff = $dm->getOne($_POST["diff"]);
                $lm = new LanguageManager();
                $lang = $lm->getOne($_POST["lang"]);
                if ($diff) {
                    if ($lang) {
                        //Prepare the data for the prompt
                        $data = ["theme" => $_POST['theme'], "quantity" => $_POST['quantity'], "lang" => $_POST['lang'], "diff" => $_POST['diff']];
                        if (isset($_POST['includeBools'])) {
                            //If checked include questions true or false
                            $data["includeBools"] = true;
                        }
                        if (isset($_POST['multiCorrect'])) {
                            //If checked include questions with multiple correct answers
                            $data["multiCorrect"] = true;
                        }
                        try {
                            //Call the API
                            $quiz = $this->callAPI($data);
                            //Generate an uniq id for the kahoot
                            $kahoot_id = uniqid();
                            //Create the kahoot in the database
                            $this->kahootManager->create($kahoot_id, $diff['id'], $lang['id'], $quiz->title);
                            //Instantiate the Managers for question and answer
                            $qm = new QuestionManager();
                            $am = new AnswerManager();
                            //For each generated questions
                            foreach ($quiz->questions as $question) {
                                //Generate an uniq id for the question
                                $question_id = uniqid();
                                //Create the question in the database
                                $qm->create($question_id, $kahoot_id, $question->question);
                                //For each generated answers
                                foreach ($question->answers as $i => $answer) {
                                    //Generate an uniq id for the answer
                                    $answer_id = uniqid();
                                    //Create the answer in the database
                                    $am->create($answer_id, $question_id, $answer, in_array($i, $question->correct_answers));
                                }
                            }
                            header("Location: /kahoot/" . $kahoot_id);
                        } catch (\Exception $e) {
                            echo $e;
                        }
                    } else {
                        //Return an error if language not found
                        $_SESSION["error"]["lang"] = "La langue choisie n'a pas été trouvée ou n'est pas prise en charge !";
                    }
                } else {
                    //Return an error if difficulty not found
                    $_SESSION["error"]["diff"] = "La difficulté choisie n'a pas été trouvée !";
                }
            } else {
                //Return errors
                header("Location: /kahoot/generate");
            }
        } else {
            //Redirect to login page
            header("Location: /account/login");
        }
    }
    public function updateKahoot(string $id): void
    {
    }
    public function deleteKahoot(string $id): void
    {
    }
    public function downloadKahoot(string $id): void
    {
        //get a kahoot
        $kahoot = $this->kahootManager->getOne($id);

        //default value in exel
        $exel = [
            ["Question - max 120 characters", "Answer 1 - max 75 characters", "Answer 2 - max 75 characters", "Answer 3 - max 75 characters", "Answer 4 - max 75 characters", "Time limit (sec) – 5, 10, 20, 30, 60, 90, 120, or 240 secs", "Correct answer(s) - choose at least one"],
        ];

        //get each question
        foreach ($kahoot->getQuestions() as $question) {
            //the line in the exel
            $line = [];

            //push the question
            array_push($line, $question->getQuestion());

            //string of index of correct answer ( exemple => "2,4")
            $is_good = "";

            foreach ($question->getAnswers() as $index => $answer) {

                //push the answer
                array_push($line, $answer->getLibelle());

                // if the answer is correct then add to the string
                if ($answer->getCorrect()) {
                    $is_good .= ($index + 1) . ",";
                }
            }

            //if not enought answer
            if (count($question->getAnswers()) < 4) {
                // max answer - actual answer 
                $answer_missing = 4 - count($question->getAnswers());

                for ($i = 0; $i < $answer_missing; $i++) {
                    //push the empty answer
                    array_push($line, "");
                }
            }

            //push the time
            array_push($line, $question->getTime());

            //push is_good
            array_push($line, $is_good);

            //push the line in the exel
            array_push($exel, $line);
        }

        //download the exel
        SimpleXLSXGen::fromArray($exel)->downloadAs('kahoot_' . date("d_m_Y") . '.xlsx');
    }

    private function callAPI(array $data): array|\stdClass
    {
        //Load API KEY
        $env = Helper::loadEnv();
        $apiKey = $env['API_TOKEN'];
        //Load URL
        $url = 'https://api.openai.com/v1/chat/completions';
        //Generate the prompt
        $prompt = "
        Crée un quiz en JSON en ".$data["lang"]." avec ".$data["quantity"]." questions sur le thème (".$data["theme"].") de difficulté (".$data["diff"]."), pour chaque question (120 caractères max), fournis 4 réponses ".(isset($data['includeBools']) ? ", ou 2 si question vrai ou faux" : "")." (75 caractères max) possibles et indique la bonne réponse (dans un tableau correct_answers".(isset($data['multiCorrect']) ? ", certaines questions (au moins une) ont plusieurs réponses correctes" : "")."). (Ne me donnes que le json, crée un titre de 20 caractères max). Utilise un JSON de ce type:

            {
                \"title\": \"\",
                \"questions\": [
                    {
                        \"question\": \"\",
                        \"answers\": [\"\"],
                        \"correct_answers\": [" . (isset($data["multiCorrect"]) ? "Index de la bonne réponse" : "Index de la(les) bonne(s) réponse(s)") . "]
                    }
                    ...
                ]
            }
        ";

        //Setup the request for API
        $messages = [
            ["role" => "system", "content" => "You are a helpful assistant."],
            ["role" => "user", "content" => $prompt]
        ];

        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => $messages,
            "max_tokens" => 4000,
            "temperature" => 0.7,
        ];

        //Setup the request for cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        //Execute the request
        $response = curl_exec($ch);
        //Set an array empty
        $res = [];

        //If cURL errors
        if (curl_errno($ch)) {
            //Show cURL errors
            $res["error"] = 'Erreur cURL : ' . curl_error($ch);
        } else {
            //Verify the http codes 
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //If correct
            if ($httpStatusCode >= 200 && $httpStatusCode < 300) {
                //Store the response in the array
                $result = json_decode($response, true);
                $str = $result['choices'][0]['message']['content'];
                echo $str;
                $res = json_decode($str);
            } else {
                //Show the API error
                $res["error"] = 'Erreur HTTP : ' . $httpStatusCode . "\n" . $response;
            }
        }

        //Close request
        curl_close($ch);
        //Return response
        return $res;
    }
}
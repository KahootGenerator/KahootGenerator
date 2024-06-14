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
use OpenAI;
use Shuchkin\SimpleXLSXGen;

final class KahootController extends Controller
{
    protected Validator $validator;
    protected KahootManager $kahootManager;
    protected OpenAI\Client $OpenAIClient;
    public function __construct()
    {
        $api_token = getenv('API_TOKEN');

        $this->validator = new Validator();
        $this->kahootManager = new KahootManager();
        $this->OpenAIClient = OpenAI::client($api_token);
    }
    public function generate(): void
    {
        //If user is signed in
        if (isset($_SESSION['user'])) {
            //Validate the fields
            $this->validator->validate([
                "theme" => ["required", "min:2", "max:50"],
                "quantity" => ["required", "numeric"],
                "lang" => ["required", "numeric"],
                "diff" => ["required", "numeric"]
            ]);
            $_SESSION["old"] = $_POST;

            $dm = new DifficultyManager();
            $diff = $dm->find($_POST["diff"]);
            $lm = new LanguageManager();
            $lang = $lm->find($_POST["lang"]);
            if (!is_object($diff)) {
                //Return an error if difficulty not found
                $_SESSION["error"]["diff"] = "La difficulté choisie n'a pas été trouvée !";
                $errors = true;
            }
            if (!is_object($lang)) {
                //Return an error if language not found
                $_SESSION["error"]["lang"] = "La langue choisie n'a pas été trouvée ou n'est pas prise en charge !";
                $errors = true;
            }
            if ($_POST["quantity"] >= 20 && $_POST["quantity"] <= 1) {
                $_SESSION["error"]["quantity"] = "Le nombre de questions doit être compris entre 1 et 20 !";
                $errors = true;
            }
            if (isset($errors)) {
                if ($errors) {
                    header("Location: /kahoot/generate");
                }
            }
            if (!$this->validator->errors()) {
                //Search the difficulty and the language in the database
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
                    $this->kahootManager->create($kahoot_id, $diff->getId(), $lang->getId(), $quiz['title']);
                    //Instantiate the Managers for question and answer
                    $qm = new QuestionManager();
                    $am = new AnswerManager();
                    //For each generated questions
                    foreach ($quiz["questions"] as $question) {
                        //Generate an uniq id for the question
                        $question_id = uniqid();
                        //Create the question in the database
                        $qm->create($question_id, $kahoot_id, $question['question']);
                        //For each generated answers
                        foreach ($question['answers'] as $i => $answer) {
                            //Generate an uniq id for the answer
                            $answer_id = uniqid();
                            //Create the answer in the database
                            $am->create($answer_id, $question_id, $answer, in_array($i, $question['correct_answers']));
                        }
                    }
                    header("Location: /kahoot/" . $kahoot_id);
                } catch (\Exception $e) {
                    echo $e;
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
        //If user is signed in
        if (isset($_SESSION['user'])) {

            $questionManager = new QuestionManager();
            $answerManager = new AnswerManager();

            //delete all the questions of the kahoot
            $questionManager->deleteAllFromKahoot($id);

            foreach ($_POST as $item) {
                //decode the item
                $question = json_decode($item, true);

                $question_id = uniqid();
                //insert the question in the database
                $questionManager->create($question_id, $id, $question["title"]);

                foreach ($question["answers"] as $answer) {
                    //insert the answer in the database
                    $answerManager->create(uniqid(), $question_id, $answer[0], $answer[1]);
                }
                // echo $question["id_time"];
            }
        } else {
            //Else 
            header("Location: /account/login");
        }
    }
    public function deleteKahoot(string $id): void
    {
        //If user is signed in
        if (isset($_SESSION['user'])) {
            //Delete the kahoot with the id
            $this->kahootManager->delete($id);
            header("Location: /kahoot");
        } else {
            //Else 
            header("Location: /account/login");
        }
    }
    public function deleteQuestion(string $id_kahoot, string $id): void
    {
        //If user is signed in
        if (isset($_SESSION['user'])) {
            //Delete the kahoot with the id
            $qm = new QuestionManager();
            $qm->delete($id);
            header("Location: /kahoot/" . $id_kahoot);
        } else {
            //Else 
            header("Location: /account/login");
        }
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

    private function callAPI(array $data): array
    {
        $env = Helper::loadEnv();

        $this->OpenAIClient = OpenAI::client($env['API_TOKEN']);

        //Generate the prompt
        $prompt = "
        Crée un quiz en JSON en " . $data["lang"] . " avec " . $data["quantity"] . " questions sur le thème (" . $data["theme"] . ") de difficulté (" . $data["diff"] . "), pour chaque question (120 caractères max), fournis 4 réponses " . (isset($data['includeBools']) ? ", ou 2 si question vrai ou faux" : "") . " (75 caractères max) possibles et indique la bonne réponse (dans un tableau correct_answers" . (isset($data['multiCorrect']) ? ", certaines questions (au moins une) ont plusieurs réponses correctes" : "") . "). (Ne me donnes que le json, crée un titre de 20 caractères max). Utilise un JSON de ce type:

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

        $gptResponse = $this->OpenAIClient->chat()->create([
            'model' => 'gpt-3.5-turbo',
            "messages" => [
                ["role" => "system", "content" => "You are a helpful assistant."],
                ["role" => "user", "content" => $prompt]
            ],
            "max_tokens" => 4000,
            "temperature" => 0.7
        ]);

        $result = json_decode($gptResponse['choices'][0]['message']['content'], true);
        //Return response
        return $result;
    }
}

<?php

namespace App\Controllers;

use App\Validator;
use App\Database\Managers\KahootManager;
use App\Core\Controller;
use App\Helper;

final class KahootController extends Controller
{
    protected Validator $validator;
    // protected KahootManager $kahootManager;
    public function __construct()
    {
        $this->validator = new Validator();
        // $this->kahootManager = new KahootManager();
    }
    public function generate(): void
    {
        
    }
    public function updateKahoot(int $id): void
    {
    }
    public function deleteKahoot(int $id): void
    {
    }

    private function callAPI(array $data): array {
        //Load API KEY
        $env = Helper::loadEnv();
        $apiKey = $env['API_TOKEN'];
        //Load URL
        $url = 'https://api.openai.com/v1/chat/completions';
        //Generate the prompt
        $prompt = "
        Crée un quiz en JSON en".$data["lang"]." avec ".$data["quantity"]." questions sur le thème (".$data["theme"].") de difficulté (".$data["diff"]."), chaque question ayant 4 réponses possibles et une indication de la bonne réponse.
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
                $res = json_decode(trim($result['choices'][0]['message']['content']));
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
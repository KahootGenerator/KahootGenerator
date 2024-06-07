<?php

namespace App\Controllers;

use App\Validator;
use App\Database\Managers\UserManager;
use App\Core\Controller;

final class AccountController extends Controller
{
    protected Validator $validator;
    protected UserManager $userManager;
    public function __construct()
    {
        $this->validator = new Validator();
        $this->userManager = new UserManager();
    }
    public function register(): void
    {
        $this->validator->validate([
            "username" => ["required", "alphaNum"],
            "password" => ["required", "min:8"],
        ]);
        echo "hahaha";
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) { // if the validator is not incorect
            $result = $this->userManager->find($_POST["username"]);
            if (empty($result)) { // if the username already exists in the DB
                // hash the password so you don't see the real password in the database
                $id = uniqid();
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->userManager->create($id, $_POST["username"], $password);
                // adds in-session registration information
                $_SESSION["user"] = [
                    "id" => $id,
                    "username" => $_POST["username"]
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['username'] = "Le nom d'utilisateur choisi est déjà utilisé !";
                header("Location: /account/register/");
            }
        } else {
            header("Location: /account/register/");
        }
    }
    public function login(): void
    {
        $this->validator->validate([
            "username" => ["required", "alphaNum"],
            "password" => ["required", "min:8"],
        ]);
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) { // if the validator is not incorect
            $result = $this->userManager->find($_POST["username"]);
            if ($result && password_verify($_POST['password'], $result->getPassword())) { // If the username already exists in the DB and the password matches the password registered in the user's DB
                // add in session the information retrieved from the database
                $_SESSION["user"] = [
                    "id" => $result->getId(),
                    "username" => $result->getUsername(),
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['message'] = "Une erreur lors de la connexion";
                header("Location: /account/login/");
            }
        } else {
            header("Location: /account/login/");
        }
    }
    public function logout(): void
    {
        // if the user is logged in, the session is deleted and redirected to the login screen
        if (isset($_SESSION["user"]["username"])) {
            session_start();
            session_destroy();
        }
        header("Location: /");
    }
}
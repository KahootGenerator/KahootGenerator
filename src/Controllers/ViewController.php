<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Validator;

final class ViewController extends Controller
{
    function showIndex()
    {
        //set title
        $this->setPageTitle("Kahoot Générator");

        //render the view index

        $this->render('index', ['title' => $this->getPageTitle(), "backgroundName" => "home"]);

    }
    function showGenerate()
    {
        //set title
        $this->setPageTitle("Choix des options !");

        //render the view generate
        $this->render('/kahoot/generate', ['title' => $this->getPageTitle(), "backgroundName" => "generation"]);
    }
    function showRegister()
    {
        //set title
        $this->setPageTitle("Creation de votre compte !");

        //render the view generate
        $this->render('account/register');
    }
    function showLogin()
    {
        //set title
        $this->setPageTitle("Connexion à votre compte !");

        //render the view generate
        $this->render('account/login');
    }

    public function showOneKahoot(int $id): void
    {
        //Set title
        $this->setPageTitle("Votre Kahoot !");

        //Render the view show
        $this->render('/kahoot/show', ['title' => $this->getPageTitle(), "backgroundName" => "kahoot"]);
    }
}
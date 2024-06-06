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
        $this->render('index');
    }
    function showGenerate()
    {
        //set title
        $this->setPageTitle("Choix des options !");

        //render the view generate
        $this->render('kahoot/generate');
    }
    function showLogin()
    {
        //set title
        $this->setPageTitle("Connexion à votre compte !");

        //render the view generate
        $this->render('account/login');
    }
}
<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Validator;

final class ViewController extends Controller
{
    //render any view
    //$this->render('index', ['title' => $this->getPageTitle()]);

    function showIndex()
    {
        //set title
        $this->setPageTitle("Kahoot Générator");

        //render the view index
        $this->render('index', ['title' => $this->getPageTitle()]);
    }
}
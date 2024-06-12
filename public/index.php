<?php

require '../vendor/autoload.php';
require '../src/Utils/Config.php';

use App\Router;
use App\Database\Creator;

$DatabaseCreator = new Creator();
$DatabaseCreator->checkDatabase();

session_start();

$Router = new Router($_SERVER['REQUEST_URI']);

// Kahoot
$Router->get('/', 'ViewController@showIndex');
$Router->get('/kahoot/', 'ViewController@showAllKahoot');
$Router->get('/kahoot/generate/', 'ViewController@showGenerate');
$Router->post('/kahoot/generate/attempt/', 'KahootController@generate');
$Router->get('/kahoot/:id/', 'ViewController@showOneKahoot');
$Router->post('/kahoot/:id/update/', 'KahootController@updateKahoot');
$Router->get('/kahoot/:id/delete/', 'KahootController@deleteKahoot');
$Router->get('/kahoot/:id/download/', 'KahootController@downloadKahoot');

// Account
$Router->get('/account/', 'ViewController@showAccount');
$Router->get('/account/login/', 'ViewController@showLogin');
$Router->post('/account/login/attempt/', 'AccountController@login');
$Router->get('/account/register/', 'ViewController@showRegister');
$Router->post('/account/register/attempt/', 'AccountController@register');
$Router->get('/account/logout/', 'AccountController@logout');

try {
    $Router->run();
} catch (Exception $e) {
    throw new Error($e);
}
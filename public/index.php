<?php

require '../vendor/autoload.php';
require '../src/Utils/Config.php';

use App\Router;
// use ScssPhp\ScssPhp\Compiler;
use App\Database\Creator;

$DatabaseCreator = new Creator();
$DatabaseCreator->checkDatabase();

// $scss = new Compiler();
// $scss->setImportPaths('./style/scss');

// try {
//     $cssOutput = $scss->compileFile('./style/scss/main.scss');
// } catch (\ScssPhp\ScssPhp\Exception\SassException $e) {
//     throw new Error((string) $e);
// }

// file_put_contents('./style/main.css', $cssOutput->getCss());

session_start();

$Router = new Router($_SERVER['REQUEST_URI']);

// Kahoot
$Router->get('/', 'ViewController@showIndex');
$Router->get('/kahoot/', 'ViewController@showAllKahoot');
$Router->get('/kahoot/generate/', 'ViewController@showGenerate');
$Router->post('/kahoot/generate/attempt/', 'KahootController@generate');
$Router->get('/kahoot/:id/', 'ViewController@showOneKahoot');
$Router->post('/kahoot/:id/delete/', 'KahootController@deleteKahoot');

// Account
$Router->get('/account/', 'ViewController@showAccount');
$Router->get('/account/login/', 'ViewController@showLogin');
$Router->post('/account/login/attempt/', 'UserController@login');
$Router->get('/account/register/', 'ViewController@showRegister');
$Router->post('/account/register/attempt/', 'UserController@register');
$Router->post('/account/logout/', 'UserController@logout');

try {
    $Router->run();
} catch (Exception $e) {
    throw new Error($e);
}
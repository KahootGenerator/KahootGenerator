<?php

require '../vendor/autoload.php';
require '../src/Utils/Config.php';

use App\Router;
use ScssPhp\ScssPhp\Compiler;
use App\Database\Creator;

$DatabaseCreator = new Creator();
$DatabaseCreator->checkDatabase();

$scss = new Compiler();
$scss->setImportPaths('./style/scss');

try {
    $cssOutput = $scss->compileFile('./style/scss/main.scss');
} catch (\ScssPhp\ScssPhp\Exception\SassException $e) {
    throw new Error((string)$e);
}

file_put_contents('./style/main.css', $cssOutput->getCss());

session_start();

$Router = new Router($_SERVER['REQUEST_URI']);

$Router->get('/auth/login', 'ViewController@renderLoginPage');
$Router->post('/auth/login/attempt', 'UserController@loginAttempt');

try {
    $Router->run();
} catch (Exception $e) {
    throw new Error($e);
}
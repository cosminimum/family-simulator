<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

(new App\Component\DotEnv(__DIR__ . '/.env'))->load();

$controller = new \App\Controller\FrontController();
$controller->renderView($controller->index(new \App\Component\Http\Request($_REQUEST)));

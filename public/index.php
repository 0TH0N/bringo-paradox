<?php

namespace Bringo\Index;

require_once __DIR__ . "/../vendor/autoload.php";

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

\session_start();
$sessionID = session_id();

$app = new \Slim\App($configuration);

$container = $app->getContainer();
$container['renderer'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');

$app->get('/', \Bringo\HomeController::class . ':home');

$app->get('/doors', \Bringo\RunController::class . ':showDoors');

$app->get('/handle', \Bringo\RunController::class . ':handle');

$app->delete('/destroy', \Bringo\RunController::class . ':destroy');

$app->run();

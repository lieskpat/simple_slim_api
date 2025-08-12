<?php

declare(strict_types=1);

use Controllers\SpeakerController;
use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Handler\FileHandler;

require __DIR__ . '/../vendor/autoload.php';

// Todo aus config holen
$path = '\\\\11.9.95.141\\Quad\\StarDiva.xml'; 
$speakerController = new SpeakerController(new FileHandler($path));

$app = AppFactory::create();

$app->get('/api/test', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("TEST FROM API!!!");
    return $response;
});

$app->get('/api/speaker', $speakerController->handle());

//$app->get('/api/speaker', \SpeakerController::class . ':show()');

$app->run();


<?php

declare(strict_types=1);

use Controllers\SpeakerController;
use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

define('APP_ROOT', dirname(__DIR__));

$containerBuilder = new ContainerBuilder;
$container = $containerBuilder->addDefinitions(APP_ROOT . '/config/definitions.php')->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/api/handle', SpeakerController::class . ':handle');
$app->get('/api/speaker', SpeakerController::class);

$app->get('/', function (Request $request, Response $response, array $args) {
    
    $response->getBody()->write("Hello");
    return $response;
    });

$app->run();


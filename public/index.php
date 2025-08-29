<?php

declare(strict_types=1);

use Controllers\SpeakerController;
use Controllers\HealthCheckController;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

// use PHP-DI container to instantiate objects for example Controller and Handler
$containerBuilder = new ContainerBuilder;
// read config for PHP-DI
$container = $containerBuilder->addDefinitions(APP_ROOT . '/config/definitions.php')
    ->build();

// set the PHP-DI container 
AppFactory::setContainer($container);
// create the app
$app = AppFactory::create();
// Parse json, form data and xml
$app->addBodyParsingMiddleware();
// use middleware for error handling
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
// format error messages in json (global)
$errorHandler->forceContentType('application/json');

//$speakerController = $container->get(SpeakerController::class);
//dump($speakerController);

// write routes
$app->get('/api/speaker', SpeakerController::class . ':handle');
$app->get('/', $container->get(HealthCheckController::class)->handle());
$app->get('/check', HealthCheckController::class);
$app->post('/api/speaker', SpeakerController::class . ':handlePost');

$app->run();

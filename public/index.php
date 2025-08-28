<?php

declare(strict_types=1);

use Controllers\SpeakerController;
use Controllers\HealthCheckController;
use Slim\Factory\AppFactory;
use Handler\FileHandler;
use Handler\SMB;
use Icewind\SMB\BasicAuth;

use DI\ContainerBuilder;

define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder;
$container = $containerBuilder->addDefinitions(APP_ROOT . '/config/definitions.php')
                              ->build();

AppFactory::setContainer($container);
$app = AppFactory::create();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->forceContentType('application/json');

//$speakerController = $container->get(SpeakerController::class);
//dump($speakerController);

$app->get('/api/speaker', SpeakerController::class . ':handle');
$app->get('/', $container->get(HealthCheckController::class)->handle());
$app->get('/check', HealthCheckController::class);

$app->run();


<?php

declare(strict_types=1);

use Controllers\SpeakerController;
use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Handler\FileHandler;
use Handler\SMB;
use Icewind\SMB\BasicAuth;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Todo Zugangsdaten aus config oder env holen
$authSMB = new BasicAuth($_ENV['SMB_USER'], $_ENV['SMB_WORKGROUP'], $_ENV['SMB_PASSWORD']); 
$smb = new SMB($authSMB, $_ENV['SMB_ADDRESS'], $_ENV['SMB_SHARE']);
$speakerController = new SpeakerController(new FileHandler($smb));

$app = AppFactory::create();

$app->get('/api/speaker', $speakerController->handle());

//$app->get('/api/speaker', \SpeakerController::class . ':show()');

$app->run();


<?php

declare(strict_types=1);

use Controllers\SpeakerController;
use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Handler\FileHandler;
use Handler\SMB;
use Icewind\SMB\BasicAuth;

require __DIR__ . '/../vendor/autoload.php';

// Todo Zugangsdaten aus config oder env holen
$authSMB = new BasicAuth('user', 'workgroup', 'password'); 
$smb = new SMB($authSMB, '11.9.95.141', 'qaud4');
$speakerController = new SpeakerController(new FileHandler($smb));

$app = AppFactory::create();

$app->get('/api/speaker', $speakerController->handle());

//$app->get('/api/speaker', \SpeakerController::class . ':show()');

$app->run();


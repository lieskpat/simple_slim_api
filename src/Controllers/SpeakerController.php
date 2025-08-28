<?php

declare(strict_types=1);

namespace Controllers;

use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Handler\FileHandler;
use \SimpleXMLElement;

class SpeakerController {

    public function __construct(private FileHandler $fileHandler) {

    }

    public function getFileHandler() {
        return $this->fileHandler;
    }

    public function __invoke(Request $request, Response $response, array $args) {

    }

    public function handle(Request $request, Response $response, array $args) {
        
        //$xmlContent = new SimpleXMLElement($this->getFileHandler()->getFileContent(APP_ROOT . 'StarDiva.xml'));

        $xmlContent = simplexml_load_file(APP_ROOT . '/StarDiva.xml');
        $payload = json_encode($xmlContent);
        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        
    }
}
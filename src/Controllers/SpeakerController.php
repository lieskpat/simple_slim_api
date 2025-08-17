<?php

declare(strict_types=1);

namespace Controllers;

use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Handler\FileHandler;
use \SimpleXMLElement;

class SpeakerController {

    private FileHandler $fileHandler;

    public function __construct(FileHandler $fileHandler) {

        $this->fileHandler = $fileHandler;

    }

    public function getFileHandler() {
        return $this->fileHandler;
    }

    public function handle() {

        $xmlContent = new SimpleXMLElement($this->getFileHandler()->getFileContent('./StarDiva.xml'));

        //$xmlContent = simplexml_load_file('StarDiva.xml');
        //$xmlContent = simplexml_load_file('/../../StarDiva.xml');

        return function (Request $request, Response $response, array $args) {

            $payload = json_encode($xmlContent);

            $response->getBody()->write($payload);

            $response->getBody()->write(__DIR__ . '/StarDiva.xml');
        
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        };
    }
}
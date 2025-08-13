<?php

declare(strict_types=1);

namespace Controllers;

use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Handler\FileHandler;

class SpeakerController {

    private FileHandler $fileHandler;

    public function __construct(FileHandler $fileHandler) {

        $this->fileHandler = $fileHandler;

    }

    public function getFileHandler() {
        return $this->fileHandler;
    }

    public function handle() {

        $xml = $this->getFileHandler()->loadXMLFile($this->getFileHandler()->getPath());

        return function (Request $request, Response $response, array $args) {

            $payload = json_encode($xml);

            $response->getBody()->write($payload);

            $response->getBody()->write("Hello From Controller");
        
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        };
    }
}
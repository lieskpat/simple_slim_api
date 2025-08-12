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

        //$xml = $this->getFileHandler()->loadXMLFile($this->getFileHandler()->getPath());
        //$json = $this->getFileHandler()->xmlToJson($xml);

        return function (Request $request, Response $response, array $args) {
            
            $response->getBody()->write("Hello From Controller");
            return $response;};
    }
}
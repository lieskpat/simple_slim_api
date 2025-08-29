<?php

declare(strict_types=1);

namespace Controllers;

use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;
use Handler\FileHandler;
use \SimpleXMLElement;
use Valitron\Validator;

class SpeakerController
{
    private FileHandler $fileHandler;

    public function __construct(FileHandler $fileHandler, private Validator $validator)
    {
        $this->fileHandler = $fileHandler;
        $this->validator->mapFieldsRules([
            'fileName' => ['required']
        ]);
    }

    public function getFileHandler()
    {
        return $this->fileHandler;
    }

    public function handle(Request $request, Response $response, array $args)
    {
        $xmlContent = new SimpleXMLElement($this->getFileHandler()->getFileContent());
        $payload = json_encode($xmlContent);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    public function handlePost(Request $request, Response $response, array $args)
    {
        // Todo post body Validierung
        // json can be processed by middleware
        $body = $request->getParsedBody();
        $this->validator = $this->validator->withData($body);

        if (!$this->validator->validate()) {
            $response->getBody()
                ->write(json_encode($this->validator->errors()));
            return $response->withStatus(422);
        }

        $fileName = $body['fileName'];
        $this->getFileHandler()->setFilename($fileName);

        $xmlContent = new SimpleXMLElement($this->getFileHandler()->getFileContent());
        $payload = json_encode($xmlContent);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}

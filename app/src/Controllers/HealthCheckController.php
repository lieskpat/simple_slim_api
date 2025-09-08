<?php

declare(strict_types=1);

namespace Controllers;

use PSR\Http\Message\ServerRequestInterface as Request;
use PSR\Http\Message\ResponseInterface as Response;

class HealthCheckController
{

    public function __invoke(Request $request, Response $response)
    {
        $data = [
            'php_version' => PHP_VERSION,
            'sapi' => php_sapi_name(),
            'extensions' => get_loaded_extensions(),
            'hallo' => 'Hallo World',
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function handle()
    {

        return function (Request $request, Response $response) {
            $data = [
                'php_version' => PHP_VERSION,
                'sapi' => php_sapi_name(),
                'extensions' => get_loaded_extensions(),
            ];

            $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-Type', 'application/json');
        };
    }
}

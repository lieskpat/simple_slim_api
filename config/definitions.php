<?php

use Dotenv\Dotenv;
use Handler\SMB;
use Icewind\SMB\BasicAuth;

$dotenv = Dotenv::createImmutable(APP_ROOT);
$dotenv->safeLoad();

return [

    BasicAuth::class => function () {
        return new BasicAuth($_ENV['SMB_USER'], $_ENV['SMB_WORKGROUP'], $_ENV['SMB_PASSWORD']);
    },

    SMB::class => function () {
        return new SMB(
            new BasicAuth($_ENV['SMB_USER'], $_ENV['SMB_WORKGROUP'], $_ENV['SMB_PASSWORD']),
            $_ENV['SMB_ADDRESS'],
            $_ENV['SMB_SHARE']
        );
    }
];

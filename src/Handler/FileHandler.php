<?php

declare(strict_types=1);

namespace Handler;

use Handler\SMB;

class FileHandler {

    public function __construct(private SMB $smb){
        
    }

    public function getFileContent(string $fileName) {

        return $this->smb->getFileContent($fileName);
    }

}
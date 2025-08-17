<?php

declare(strict_types=1);

namespace Handler;

use Handler\SMB;

class FileHandler {

    private SMB $smb;

    public function __construct(SMB $smb){

        $this->smb = $smb;
        
    }

    public function getFileContent(string $fileName) {

        return $this->smb->getFileContent($fileName);
    }

}
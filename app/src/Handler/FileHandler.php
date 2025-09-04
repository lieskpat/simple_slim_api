<?php

declare(strict_types=1);

namespace Handler;

use Handler\SMB;

class FileHandler
{
    public function __construct(private SMB $smb, private string $fileName) {}

    public function setFilename(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileContent()
    {
        return $this->smb->getFileContent($this->fileName);
    }
}

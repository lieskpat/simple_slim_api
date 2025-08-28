<?php

declare(strict_types=1);

namespace Handler;

use Icewind\SMB\ServerFactory;
use Icewind\SMB\IAuth;
use Icewind\SMB\IShare;

class SMB {

    private $smbConnection;

    private IShare $share;

    public function __construct(private IAuth $auth, private string $smbServerAddress, private string $shareName) {

        try {
            $this->smbConnection = $this->connectShare($auth, $smbServerAddress);
        } catch (Error $e) {
            echo 'Error';
        }
        $this->setShare($shareName);

    }

    private function connectShare(IAuth $auth, $smbServerAddress) {
           
        $serverFactory = new ServerFactory();
        $smbConnection = $serverFactory->createServer($smbServerAddress, $auth);
        return $smbConnection;

    }

    public function setShare(string $shareName) {

        // Todo sicherstellen das smbConnection gesetzt ist
        $this->share = $this->smbConnection->getShare($shareName);

    }

    public function getShare() {

        return $this->share;
    }

    public function listFilesInShare():array {
        // list files in the share
        return $this->getShare()->dir();

    }

    public function getFileContent(string $fileName) {

        return $this->getShare()->read($fileName);

    }

    public function fileUpload(string $newFileName, string $fileContent) {
        $this->getShare()->put($newFileName, $fileContent);
    }
}
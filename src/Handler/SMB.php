<?php

declare(strict_types=1);

namespace Handler;

use Icewind\SMB\ServerFactory;
use Icewind\SMB\IAuth;
use Icewind\SMB\IShare;

class SMB {

    private $smbConnection;

    private IShare $share;

    private IAuth $auth;

    public function __construct(IAuth $auth, string $smbServerAddress, string $shareName) {

        $this->auth = $auth;
        // Todo try catch Block Exception abfangen
        $this->smbConnection = $this->connectShare($auth, $smbServerAddress);
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
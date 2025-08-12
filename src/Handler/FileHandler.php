<?php

declare(strict_types=1);

namespace Handler;

class FileHandler {

    private string $path;

    public function __construct(string $path){

        $this->path = $path;
    }

    public function getPath(){
        return $this->path;
    }

    public function loadXMLFile() {

        if (file_exists($this->getPath())) {
            $simpleXMLElement = simplexml_load_file($this->getPath());
        }
        return simpleXMLElement;
    }

    public function xmlToJson(SimpleXMLElement $xmlObject) {
        return json_encode($xmlObject);
    }



}
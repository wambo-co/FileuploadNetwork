<?php

namespace GeneralServices;

class ReadXML
{
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getArray()
    {
        $xmlfile = file_get_contents($this->path);
        $object = simplexml_load_string($xmlfile);
        $json = json_encode($object);
        $xml = json_decode($json, true);
        return $xml;
    }
}
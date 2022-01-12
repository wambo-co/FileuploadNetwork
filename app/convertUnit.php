<?php

namespace app;

class convertUnit
{
    protected $fileSize;

    public function __construct(int $fileSize)
    {
        $this->fileSize = $fileSize;
    }

    public function convertToMb()
    {
       return round($this->fileSize / 1000024,2);
    }

}
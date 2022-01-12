<?php
namespace fileUploadNetwork;

class Header
{
    public string $inputTitle;
    public array $inputStylesheets = [];

    public function __construct($inputTitle, array $inputStylesheets)
    {
        $this->inputTitle = $inputTitle;
        $this->inputStylesheets = $inputStylesheets;
    }

    public function generateHeader() : string
    {
        $title = "<title>".$this->inputTitle."</title>";
        $generatedHeader = $title;
        foreach ($this->inputStylesheets as $stylesheet){
            $generatedHeader .= "<link rel='stylesheet' href='".$stylesheet."'>";
        }
        return $generatedHeader;
    }
}


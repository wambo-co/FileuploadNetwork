<?php
namespace fileUploadNetwork;

class Header
{
    public string $inputTitle;
    public array $inputStylesheets = [];
    public array $inputJs = [];

    public function __construct($inputTitle, array $inputStylesheets, array $inputJs)
    {
        $this->inputTitle = $inputTitle;
        $this->inputStylesheets = $inputStylesheets;
        $this->inputJs = $inputJs;
    }

    public function generateHeader() : string
    {
        $title = "<title>".$this->inputTitle."</title>";
        $generatedHeader = $title;
        foreach ($this->inputStylesheets as $stylesheet){
            $generatedHeader .= "<link rel='stylesheet' href='".$stylesheet."'>";
        }
        foreach ($this->inputJs as $js){
            $generatedHeader .= "<script src='$js'></script>";
        }
        return $generatedHeader;
    }
}


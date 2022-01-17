<?php
namespace GeneralServices;
use GeneralServices\ReadXML;

class LanguageSelector
{

    public function getLanguage(): ReadXML
    {
        if($_GET['language'] == "russian"){
            setcookie("language", "russian");
            return $xml = new ReadXML('src/xml_languages/russian_language.xml');

        }else if($_GET['language'] == "german"){
            setcookie("language", "german");
            return $xml = new ReadXML('src/xml_languages/german_language.xml');

        }else if($_GET['language'] == "china"){
            setcookie("language", "china");
            return  $xml = new ReadXML('src/xml_languages/chinesisch_language.xml');

        }else{
            if($_COOKIE['language'] == "german"){
                return $xml = new ReadXML("src/xml_languages/german_language.xml");
            }else if($_COOKIE['language'] == "china"){
                return $xml = new ReadXML("src/xml_languages/chinesisch_language.xml");
            }else if($_COOKIE['language'] == "russian"){
                return $xml = new ReadXML("src/xml_languages/russian_language.xml");
            }else {
                return $xml = new ReadXML("src/xml_languages/german_language.xml");
            }
        }

    }

}
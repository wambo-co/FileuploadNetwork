<?php
session_start();
require_once ('vendor/autoload.php');
use fileUploadNetwork\{Header, LoginBody, RegisterBody, UserBody, ViewController, ReadXML};

// Datenbank Verbindung
$db_db = 'uploadyourdata';
$db_connection = new mysqli("localhost", "root","root",$db_db);

// Select Language //
if($_GET['language'] == "russian"){
    $xml = new ReadXML('src/xml_languages/russian_language.xml');
    setcookie("language", "russian");
}else if($_GET['language'] == "german"){
    $xml = new ReadXML('src/xml_languages/german_language.xml');
    setcookie("language", "german");
}else if($_GET['language'] == "china"){
    $xml = new ReadXML('src/xml_languages/chinesisch_language.xml');
    setcookie("language", "china");
}else{
    if($_COOKIE['language'] == "german"){
        $xml = new ReadXML("src/xml_languages/german_language.xml");
    }else if($_COOKIE['language'] == "china"){
        $xml = new ReadXML("src/xml_languages/chinesisch_language.xml");
    }else if($_COOKIE['language'] == "russian"){
        $xml = new ReadXML("src/xml_languages/russian_language.xml");
    }else {
        $xml = new ReadXML("src/xml_languages/german_language.xml");
    }
}
$xml = $xml->getArray();

// Seiten erstellen aus XML
$header = new Header($xml['header']['name'], $xml['header']['css'], $xml['header']['js']);

$loginSiteBody = new LoginBody($xml['loginpage']['username'], $xml['loginpage']['password'],
$xml['loginpage']['loginBtn'], $xml['loginpage']['qText']);

$registerSiteBody = new RegisterBody($db_connection, $xml['regpage']['username'], $xml['regpage']['password'],
$xml['regpage']['email'], $xml['regpage']['register'], $xml['regpage']['alreadyRegister'],
$xml['regpage']['yourUsername'], $xml['regpage']['yourPassword'],$xml['regpage']['yourEmail']);

$userSiteBody = new UserBody($db_connection,$loginSiteBody);

$view = new ViewController($db_connection, $loginSiteBody, $registerSiteBody, $userSiteBody);
$view->isLoggedIn();
?>
<html lang="de">
<head><?=$header->generateHeader(); ?></head>
<body>
<?=$view->route(); ?>
</body>
</html>


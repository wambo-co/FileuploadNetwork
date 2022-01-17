<?php
session_start();
require_once ('vendor/autoload.php');
use BaseElements\Header;
use GeneralServices\LanguageSelector;
use Controller\ViewController;
use LoginPage\LoginBody;
use RegisterPage\RegisterBody;
use UserPage\UserBody;

// Datenbank Verbindung //
$db_db = 'uploadyourdata';
$db_connection = new mysqli("localhost", "root","root",$db_db);

// Sprache wählen und XML laden //
$selector = new LanguageSelector();
$xml = $selector->getLanguage();
$xml = $xml->getArray();

// Seiten generieren aus der XML Datei //
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
<head>
    <?=$header->generateHeader(); ?>
</head>
<body>
    <?=$view->route(); ?>
</body>
</html>


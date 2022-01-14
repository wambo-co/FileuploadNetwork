<?php
session_start();
require_once ('vendor/autoload.php');
use fileUploadNetwork\{Header, LoginBody, RegisterBody, UserBody, ViewController, ReadXML};

// Datenbank Verbindung
$db_db = 'uploadyourdata';
$db_connection = new mysqli("localhost", "root","root",$db_db);

// XML convertieren
$xml = new ReadXML('config.xml');
$xml = $xml->getArray();

// Seiten erstellen aus XML
$header = new Header($xml['header']['name'], $xml['header']['css']);

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
<body><?=$view->route(); ?></body>
</html>


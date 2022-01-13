<?php
session_start();
// idee php , eine Xml datei erstellen mit der die gesamte seite generiert wird
// alle seiten in das array packen

require_once ('vendor/autoload.php');
use fileUploadNetwork\{Login, Register, UserInformation, UserInformationInterface, ConvertUnit,
    StorageController, Upload, DeleteUserData, GetUserData, MysqlConnection, Header, LoginBody, RegisterBody,
    UserBody, ViewController};

// Datenbank Verbindung
$db_db = 'uploadyourdata';
$db_connection = new mysqli("localhost", "root","root",$db_db);

// Header generieren //
$header = new Header("test",[
    "node_modules/bulma/css/bulma.css",
    "node_modules/bootstrap-icons-font/dist/bootstrap-icons-font.css",
    "src/css/main.css",
]);
// Login seite generieren //
$loginSiteBody = new LoginBody(
    "Benutzername: ",
    "Passwort: ",
    "Einloggen",
    "Noch keinen Account? Jetzt registrieren!"
);
// Registrierungsseite generieren //
$registerSiteBody = new RegisterBody(
        $db_connection,
        "Username:",
    "Password:",
    "Email",
    "Registrieren",
    "Bereits registriert? Jetzt einloggen",
    "Dein Benutzername",
    "Dein Passwort",
    "Deine Email"
);
// User Personal Site generieren //
$userSiteBody = new UserBody(
        $db_connection,
);
$view = new ViewController($db_connection, $loginSiteBody, $registerSiteBody, $userSiteBody);
$view->isLoggedIn();
?>
<html lang="de">
<head>
    <?=$header->generateHeader(); ?>
</head>
<body>
    <!--<div class="is-vcentered has-text-centered">
        <div class="notification is-warning notification-box"> <b>-->
           <?php
           echo $view->route(); ?>
       <!-- </b></div>
    </div>-->
</body>
</html>


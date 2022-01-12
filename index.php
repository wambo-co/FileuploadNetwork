<?php
session_start();
require_once ('vendor/autoload.php');
use fileUploadNetwork\{Login, Register, UserInformation, UserInformationInterface, ConvertUnit,
    StorageController, Upload, DeleteUserData, GetUserData, MysqlConnection, Header, LoginBody, RegisterBody,
    UserSiteBody};


//TODO: einen besseren Weg finden um die Seiten zu laden bzw. zu switchen
$loadLoginBody = false;
$loadRegisterBody = false;
$loadUserBody = true;
if(isset($_GET['login'])){
    $loadLoginBody = true;
}else if(isset($_GET['register'])){
    $loadRegisterBody = true;
}else if(isset($_GET['userspace'])){
    $loadUserBody = true;
}


//TODO: besser verpacken!
$db_db = 'uploadyourdata';
$db_connection = new MysqlConnection("localhost", "root","root",$db_db);


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

// Personalisierte User Seite generieren //

$userSiteBody = new UserSiteBody(
        $db_connection->getMysqli(),
    "user",
    "t",
    "t",
    "t",
    "t",
    "t",
    "t"
);
?>
<html lang="de">
<head>
    <?=$header->generateHeader(); ?>
</head>
<body>
    <?php
    if($loadLoginBody){echo $loginSiteBody->generateBody();}
    if($loadRegisterBody){echo $registerSiteBody->generateBody();}
    if($loadUserBody){echo $userSiteBody->generateBody();}
    ?>
</body>
</html>




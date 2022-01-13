<?php

namespace fileUploadNetwork;

class ViewController
{
    public $mysqlConnection;
    public $username;


    public function __construct($mysqlConnection, $username)
    {
        $this->mysqlConnection = $mysqlConnection;
        $this->username = $username;
    }


    public function forwardOnRequest()
    {

    }

    public function postNotficiation()
    {
        if(isset($_POST['login'])){
            $userInformation = new userInformation($this->username, $this->mysqlConnection);
            if($userInformation->isUserAviable()){
                $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $this->mysqlConnection);
                $regist->newUser();

                //davor stand login.php
            }else{
                header("Location: index.php?registrationStatus=userAlreadyAssigned");
                //davor stand userRegistration.php

            }
        }

        if (isset($_GET['loggedOut'])) {
            if ($_GET['loggedOut'] == "sessionExpired") {
                echo "Sitzung abgelaufen!";
            }
        } else if (isset($_GET['loginStatus'])) {
            if ($_GET['loginStatus'] == "fail") {
                echo "Nutzer konnte nicht eingeloggt werden. Password oder Benutzername exisitiert nicht!";
            } else if ($_GET['loginStatus'] == "logout") {
                session_destroy();
                echo "Sitzung wurde beendet, Nutzer wurde erfolgreich ausgeloggt!";
            } else if ($_GET['loginStatus'] == "newuser") {
                echo "Neuer Nutzer wurde erfolgreich angelegt, sie können sich jetzt einloggen";
            }
        }
        if(isset($_POST['register'])){
            $userInformation = new userInformation($_POST['username'], $mysqli);
            if($userInformation->isUserAviable()){
                $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $mysqli);
                $regist->newUser();
                header("Location: login.php?loginStatus=newuser");
            }else{
                header("Location: userRegistration.php?registrationStatus=userAlreadyAssigned");
            }
        }

        if(isset($_GET['registrationStatus'])){
            if($_GET['registrationStatus'] == "userAlreadyAssigned"){
                echo "Diesen Benutzer gibt es bereits. Bitte wähle einen anderen Namen aus!";
            }
        }
    }

}
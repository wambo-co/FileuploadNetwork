<?php

namespace fileUploadNetwork;

class ViewController
{
    public $mysqlConnection;
    public LoginBody $loginSiteBody;
    public RegisterBody $registerSiteBody;
    public UserBody $userSiteBody;


    public function __construct($mysqlConnection, $loginSiteBody, $registerSiteBody, $userSiteBody)
    {
        $this->mysqlConnection = $mysqlConnection;
        $this->loginSiteBody = $loginSiteBody;
        $this->registerSiteBody = $registerSiteBody;
        $this->userSiteBody = $userSiteBody;
    }

    public function route(): string
    {
       if($_SESSION['username']){
           return $this->loadUserBody();
       }else if(isset($_GET['register'])){
            return $this->loadRegisterBody();
       }else if(isset($_POST['username']) && isset($_POST['password'])){
            return $this->authentication();
       } else {
          return $this->loadLoginBody();
       }
    }

    public function loadLoginBody()
    {
        if($_POST['login'] == "wrongdata"){
            echo "Falsche Daten wurden eingegeben!";
        }else if($_POST['login'] == "newuser"){
            echo "Benutzer wurde erstellt!";
        }else if($_POST['login'] == "sessionExpired"){
            echo "Sitzung abgelaufen!";
        }
        return $this->loginSiteBody->generateBody();
    }

    public function loadRegisterBody()
    {
        if(isset($_POST['register'])){
            $userInformation = new userInformation($_POST['username'], $this->mysqlConnection);
            if($userInformation->isUserAviable()){
                $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $this->mysqlConnection);
                $regist->newUser();
                $_POST['login'] = "newuser";
                return $this->loadLoginBody();
            }else{
                echo "user gibt es schon";
            }
        }
        return $this->registerSiteBody->generateBody();
    }

    public function authentication()
    {
        $loginUser = new login($_POST['username'], $_POST['password'], $this->mysqlConnection);

        if($loginUser->login()){
            $_SESSION['username'] = $_POST['username'];
            return $this->route();
        }else{
            $_POST['login'] = "wrongdata";
            return $this->loadLoginBody();
        }
    }

    public function loadUserBody()
    {
        if(!isset($_SESSION['username'])){
            $_POST['login'] = "sessionExpired";
            return $this->loadLoginBody();
        }
        return $this->userSiteBody->generateBody();
    }


}

//TODO: Feld ist verschoben weil das echo innerhalb der Notification Box generiert wird
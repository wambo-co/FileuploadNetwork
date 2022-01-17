<?php

namespace Controller;

use LoginPage\Login;
use LoginPage\LoginBody;
use RegisterPage\RegisterBody;
use Registerpage\Register;
use UserPage\UserBody;
use UserPage\UserInformation;

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
        if($this->isAuthenticated()){
            return $this->loadUserBody();
        }else if(isset($_GET['register'])){
            return $this->loadRegisterBody();
        }else if(isset($_POST['username']) && isset($_POST['password'])){
            return $this->authentication();
        } else {
            return $this->loadLoginBody();
        }
    }


    public function isLoggedIn()
    {
       if(isset($_GET['logout'])) {
           session_destroy();
           $this->route();
        }
    }


    public function isAuthenticated() :bool
    {
        return isset($_SESSION['username']);
    }


    public function authentication(): string
    {
        $loginUser = new login($_POST['username'], $_POST['password'], $this->mysqlConnection);

        if($loginUser->login()){  // wenn es true ist → also user existiert und das passwort stimmt
            $_SESSION['username'] = $_POST['username'];
            return $this->route();
        }else{
            $_POST['login'] = "wrongdata";
            return $this->loadLoginBody();
        }
    }


    public function loadLoginBody(): string
    {
        if(isset($_POST['login']) && $_POST['login'] == "wrongdata"){
            echo "Falsche Daten wurden eingegeben!";
        }else if(isset($_POST['login']) && $_POST['login'] == "newuser"){
            echo "Benutzer wurde erstellt!";
        }else if(isset($_POST['login']) && $_POST['login'] == "sessionExpired"){
            echo "Sitzung abgelaufen!";
        }
        return $this->loginSiteBody->generateBody();
    }


    public function loadRegisterBody(): string
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


    public function loadUserBody(): string
    {
        if(!isset($_SESSION['username'])){
            $_POST['login'] = "sessionExpired";
            return $this->loadLoginBody();
        }
        return $this->userSiteBody->routingInsideUserSite();
    }

}

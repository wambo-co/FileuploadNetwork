<?php

namespace fileUploadNetwork;


class RegisterBody
{
    public $mysqlConnection;
    public $usernameLabel;
    public $passwordLabel;
    public $emailLabel;
    public $usernamePlaceholder;
    public $passwordPlaceholder;
    public $emailPlaceholder;


    public $registerButtonText;
    public $accountExistLinkText;

    public function __construct(
        $mysqlConnection, $usernameLabel, $passwordLabel, $emailLabel,
        $registerButtonText, $accountExistLinkText, $usernamePlaceholder,
        $passwordPlaceholder, $emailPlaceholder)
    {
        $this->mysqlConnection = $mysqlConnection;
        $this->usernameLabel = $usernameLabel;
        $this->passwordLabel = $passwordLabel;
        $this->emailLabel = $emailLabel;
        $this->registerButtonText = $registerButtonText;
        $this->accountExistLinkText = $accountExistLinkText;
        $this->usernamePlaceholder = $usernamePlaceholder;
        $this->passwordPlaceholder = $passwordPlaceholder;
        $this->emailPlaceholder = $emailPlaceholder;
    }

    public function generateBody() : string
    {

        $bodyGeneratedHtml = "<div class='is-vcentered has-text-centered'><div class='notification is-warning notification-box'><b>";
        if(isset($_POST['submit'])){
            $userInformation = new userInformation($_POST['username'], $this->mysqlConnection);
            if($userInformation->isUserAviable()){
                $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $this->mysqlConnection);
                $regist->newUser();
                header("Location: index.php?loginStatus=newuser");
                //davor stand login.php
            }else{
                header("Location: index.php?registrationStatus=userAlreadyAssigned");
                //davor stand userRegistration.php
            }
        }
        if(isset($_GET['registrationStatus'])){
            if($_GET['registrationStatus'] == "userAlreadyAssigned"){
                $bodyGeneratedHtml .= "Diesen Benutzer gibt es bereits. Bitte wähle einen anderen Namen aus!";
            }
        }
        $bodyGeneratedHtml .= "</b></div></div>
        <form action='userRegistration.php' method='post' class='box form-box'>
            <div class='field'>
                <label class='label'>$this->usernameLabel<input class='input is-small' type='text' name='username' placeholder='$this->usernamePlaceholder'></label>
            </div>
            <div class='field'>
                <label class='label'>$this->passwordLabel<input class='input is-small' type='password' name='password' placeholder='$this->passwordPlaceholder'></label>
            </div>
            <div class='field'>
                <label class='label'>$this->emailLabel<input class='input is-small' type='text' name='email' placeholder='$this->emailPlaceholder'></label>
            </div>
            <div class='field'>
                <button class='button is-dark' type='submit' name='submit'>$this->registerButtonText</button>
                <br>
                <b><u><a href='index.php?login' class='has-text-dark is-size-7'>$this->accountExistLinkText</a></u><b>
            </div>
        </form>";

        return $bodyGeneratedHtml;


    }


}
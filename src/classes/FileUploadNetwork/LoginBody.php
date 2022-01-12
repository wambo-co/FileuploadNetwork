<?php

namespace fileUploadNetwork;

class LoginBody
{
    public $usernameLabel;
    public $passwordLabel;
    public $loginButtonText;
    public $notRegistratedLink;

    public function __construct($usernameLabel, $passwordLabel, $loginButtonText, $notRegistratedLink)
    {
        $this->usernameLabel = $usernameLabel;
        $this->passwordLabel = $passwordLabel;
        $this->loginButtonText = $loginButtonText;
        $this->notRegistratedLink = $notRegistratedLink;
    }

    public function generateBody()
    {
        $bodyGeneratedHtml = "<div class='is-vcentered has-text-centered'><div class='notification is-warning notification-box'><b>";
        if(isset($_GET['loggedOut'])){
            if($_GET['loggedOut'] == "sessionExpired"){
                $bodyGeneratedHtml .= "Sitzung abgelaufen!";
            }
        }else if(isset($_GET['loginStatus'])){
            if($_GET['loginStatus'] == "fail"){
                $bodyGeneratedHtml .= "Nutzer konnte nicht eingeloggt werden. Password oder Benutzername exisitiert nicht!";
            }else if($_GET['loginStatus'] == "logout"){
                session_destroy();
                $bodyGeneratedHtml .= "Sitzung wurde beendet, Nutzer wurde erfolgreich ausgeloggt!";
            }else if($_GET['loginStatus'] == "newuser"){
                $bodyGeneratedHtml .= "Neuer Nutzer wurde erfolgreich angelegt, sie können sich jetzt einloggen";
            }
        }

        $bodyGeneratedHtml .= "</b></div></div>
        <form action='' method='post' class='box form-box'>
            <div class='field'>
                <label class='label'>$this->usernameLabel</label><input class='input is-small' type='text' name='username' placeholder='username'>
            </div>
            <div class='field'>
                <label class='label'>$this->passwordLabel</label><input class='input is-small' type='password' name='password' placeholder='password'>
            </div>
                <div class='field'>
                <button class='button is-dark' type='submit' name='submit'>$this->loginButtonText</button>
                <br>
                <b><u><a href='index.php?register' class='has-text-dark is-size-7'>$this->notRegistratedLink</a></u><b>
            </div>
        </form>";

        return $bodyGeneratedHtml;
    }


}
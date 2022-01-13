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
        $bodyGeneratedHtml = "<form action='' method='post' class='box form-box'>";
        $bodyGeneratedHtml .= "
        <form action='' method='post' class='box form-box'>
            <div class='field'>
                <label class='label'>$this->usernameLabel</label><input class='input is-small' type='text' name='username' placeholder='username'>
            </div>
            <div class='field'>
                <label class='label'>$this->passwordLabel</label><input class='input is-small' type='password' name='password' placeholder='password'>
            </div>
                <div class='field'>
                <button class='button is-dark' type='submit' name='login'>$this->loginButtonText</button>
                <br>
                <b><u><a href='index.php?register' class='has-text-dark is-size-7'>$this->notRegistratedLink</a></u><b>
            </div>
        </form>";
        return $bodyGeneratedHtml;
    }


}
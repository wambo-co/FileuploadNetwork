<?php

namespace RegisterPage;


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
        $bodyGeneratedHtml =  "<form action='' method='post' class='box form-box'>";
        $bodyGeneratedHtml .= "
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
                <button class='button is-dark' type='submit' name='register'>$this->registerButtonText</button>
                <br>
                <b><u><a href='index.php?login' class='has-text-dark is-size-7'>$this->accountExistLinkText</a></u><b>
            </div>
        </form>";

        return $bodyGeneratedHtml;


    }


}
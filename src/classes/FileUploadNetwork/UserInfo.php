<?php

namespace fileUploadNetwork;
use fileUploadNetwork\UserInformation;
use fileUploadNetwork\ConvertUnit;
use fileUploadNetwork\StorageController;

class UserInfo
{
    public $userLoggedIn;
    public $mysqlConnection;
    public $userInformation;

    public function __construct($userLoggedIn,$userInformation, $mysqlConnection)
    {
        $this->userLoggedIn = $userLoggedIn;
        $this->userInformation = $userInformation;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function loadVariables()
    {
        $userSource = $this->userInformation->getUserAccountInformation();
        return [
              "email" =>  $userSource[3],
            "picture" => $userSource[4],
            "status" => $userSource[5],
            "group" => $userSource[6]
        ];
    }

    public function generateUserProfile()
    {
        $userInformation = $this->loadVariables();
        $generatedHTML = "
         <div class='box user-box'>
            <article class='media'>
                <div class='media-left'>
                    <figure class='image is-64x64'>
                        <img src='<?php echo $userInformation[picture]?>' onerror='this.onerror=null; this.src='assets/pictures/default.webp' alt='Image'>
                    </figure>
                </div>
                <div class='media-content'>
                    <div class='content'>
                        <p>
                            <strong><?php echo $userInformation[username] ?></strong> <small><?php echo $userInformation[picture]?></small>
                            <br>
                            Status: <?php echo $userInformation[status] ?>
                            <br>
                            Mitgliedschaft: <?php echo $userInformation[picture] ?>
                            <br>
                            Speicherplatz: <?php echo $userInformation[picture] ?> MB
                            <br>
                            <progress class='progress'  value='<?=$userInformation[picture]?>' max='100'></progress>
                            Du hast bereits <?php echo $userInformation[picture]e ?> MB von <?php echo $userInformation[picture] ?>
                            MB verbraucht.
                            <br>
                        </p>
                    </div>
                </div>
            </article>
        </div>";
    }


}
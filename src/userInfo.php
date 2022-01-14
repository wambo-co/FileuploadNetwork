<?php
use app\userInformation;
use app\storageController;
use app\convertUnit;

$userLoggedIn = new userInformation($username, $mysqli);
$userSource = $userLoggedIn->getUserAccountInformation();
$userEmail =  $userSource[3];
$userPicture =  $userSource[4];
$userStatus = $userSource[5];
$userGroup = $userSource[6];
$userStorage = new storageController($username, 0,0,$mysqli);

$userStorageSpace = (new convertUnit($userStorage->getUserFullSpace()))->convertToMb();
// variable gespeichert Gesamter Speicherplatz

$userUsedStorageSpace =(new convertUnit($userStorage->getUserActualSpaceUsage()))->convertToMb();
// benutzer speicher
$userUsedStoragePercent = $userStorage->getUserUsedSpaceInPercent($userStorageSpace,$userUsedStorageSpace);
// in % der benutzte speicher



?>
<div class='box user-box'>
    <article class='media'>
        <div class='media-left'>
            <figure class='image is-64x64'>
                <img src='<?php echo $userPicture?>' onerror='this.onerror=null; this.src='../assets/pictures/default.webp'' alt='Image'>
            </figure>
        </div>
        <div class='media-content'>
            <div class='content'>
                <p>
                    <strong><?php echo $username ?></strong> <small><?php echo $userEmail?></small>
                    <br>
                    Status: <?php echo $userStatus ?>
                    <br>
                    Mitgliedschaft: <?php echo $userGroup ?>
                    <br>
                    Speicherplatz: <?php echo $userStorageSpace ?> MB
                    <br>
                    <progress class='progress'  value='<?=$userUsedStoragePercent?>' max='100'></progress>
                    Du hast bereits <?php echo $userUsedStorageSpace ?> MB von <?php echo $userStorageSpace ?>
                    MB verbraucht.
                    <br>
                </p>
            </div>
        </div>
    </article>
</div>

<!--<script src="js/progressbarAnimation.js"></script>  Animation wird immer wieder abgespielt-->
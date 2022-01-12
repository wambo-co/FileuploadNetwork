<?php
use app\userInformation;
$userLoggedIn = new userInformation($username, $mysqli);
$userSource = $userLoggedIn->getUserAccountInformation();
$userEmail =  $userSource[3];
$userPicture =  $userSource[4];
$userStatus = $userSource[5];
$userGroup = $userSource[6];
$userStorageSpace = "10 GB";
$userFreeStorageSpace = "1024 MB";
$userUsedStorageSpace = "10 MB";
$userUsedStoragePercent = "30";

?>
<div class="box user-box">
    <article class="media">
        <div class="media-left">
            <figure class="image is-64x64">
                <img src="<?php echo $userPicture?>" onerror="this.onerror=null; this.src='../assets/pictures/default.webp'" alt="Image">
            </figure>
        </div>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong><?php echo $username ?></strong> <small><?php echo $userEmail?></small>
                    <br>
                    Status: <?php echo $userStatus ?>
                    <br>
                    Mitgliedschaft: <?php echo $userGroup ?>
                    <br>
                    Speicherplatz: <?php echo $userStorageSpace ?>
                    <br>
                    <progress class="progress"  value="<?=$userUsedStoragePercent?>" max="100"></progress>
                    Du hast bereits <?php echo $userUsedStorageSpace ?> von <?php echo $userStorageSpace ?>
                    verbraucht.
                    <br>
                </p>
            </div>
        </div>
    </article>
</div>

<!--<script src="js/progressbarAnimation.js"></script>  Animation wird immer wieder abgespielt-->
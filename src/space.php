<?php
session_start();
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');

use app\getuserid;
use app\getAccountInformation;

if($_SESSION['username'] == NULL){
    session_destroy();
    header("Location: ../login.php?loggedOut=sessionExpired");
}else{
    $username = $_SESSION['username'];
}

if($_SESSION['username'] == "admin"){
    echo "
    <div class='admin-space'><h3>Admin Bereich</h3></div>
   ";
}


?>

<html>
<head>
    <title>Welcome</title>
    <?php
    include ('../elements/header.php');
    ?>
</head>
<body>
<?php
$userSource = (new getAccountInformation($username, $mysqli))->getDataArray();
$userEmail =  $userSource[3];
$userPicture =  $userSource[4];
$userStatus = $userSource[5];
$userGroup = $userSource[6];

$userStorageSpace = "/";
$userFreeStorageSpace = "/";
$userUsedStorageSpace = "/";


/*
 * <a href="fileUpload.php">Dateien hochladen</a>

 */
?>

<div class="box user-box">
    <article class="media">
        <div class="media-left">
            <figure class="image is-64x64">
                <img src="<?php echo $userPicture?>" alt="Image">
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
                    <progress class="progress" value="15" max="100">15%</progress>
                    Du hast bereits <?php echo $userUsedStorageSpace ?> von <?php echo $userStorageSpace ?>
                    verbraucht.
                    <br>
                    </p>
                <a href="fileUpload.php">Eine neue Datei hochladen</a>

            </div>
        </div>
    </article>
</div>
</body>
</html>

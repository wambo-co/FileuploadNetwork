<?php
session_start();
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');


use app\upload;
use app\getuserid;
use app\getuserdata;
use app\deleteUserData;

$userId= (new getuserid($_SESSION['username'], $mysqli))->getID();
$user = (new getuserdata($userId, $mysqli));
$userdata = $user->getData();
$userdataid = $user->getDataId();
$dataLocation = $user->getDataLocation();


echo "<br>";

$username = $_SESSION['username'];

if($_SESSION['username'] == "admin"){
    echo "
    <div class='admin-space'><h3>Admin Bereich</h3></div>
   ";
}
?>
<html>
<head>
    <?php
    include ('../elements/header.php');
    ?>
    <title>Private Space</title>
</head>
<body>
<div class="box">
    <div class="is-vcentered has-text-centered ">
        <div class="notification is-warning notification-box"><b>
                <?php
                if($_SESSION['username'] == NULL){
                    session_destroy();
                    header("Location: ../login.php?loggedOut=sessionExpired");
                }
                if(isset($_POST['submit'])){
                    session_destroy();
                    header("Location: ../login.php?loginStatus=logout");
                }
                if(isset($_GET['delete'])){
                    echo "<br>Datei wurde erfolgreich gelöscht<br>";
                }
                if(isset($_GET['upload'])){
                    if($_GET['upload'] == "success"){
                        $fileName = $_GET['fileName'];
                        $fileSize = $_GET['fileSize'];
                        $fileDestination = $_GET['fileDestination'];
                        $fileUploadTime = $_GET['uploadTime'];

                        echo $fileDestination." Destination<br>";
                        echo $fileUploadTime." hochladedatum<br>";
                        echo "Datei erfolgreich hochgeladen!";
                        (new upload($userId, $fileName, $fileSize, $fileDestination, $fileUploadTime, $mysqli))->upload();
                        header("Location: fileUpload.php");

                    }else if($_GET['upload'] == "errorsize"){
                        echo "Datei ist zu groß!";
                    }else if($_GET['upload'] == "wrongtype"){
                        echo "Falsche Datentyp!";
                    }
                }

                ?></b></div>
        <?php //echo "insgesamt: ".(new getuserdata($userid,2, $mysqli))->getDataRange()." Daten wurden gefunden"; ?>
    <form action="fileUploadService/upload.php" method="post" enctype="multipart/form-data"> <!-- damit können wir auch bilder verschicken durch die
    php datei -->

        <input type="file" name="file" class="form-control-file">
        <button type="submit" name="upload" class="button is-small is-light">Hochladen</button>
        <button class="button is-small " onclick="window.open('space.php')"><i class="bi bi-person-fill"></i></button>
        <button  name="submit" class="button is-small" onclick="window.open('../login.php?loginStatus=logout')"><i class="bi bi-box-arrow-right"></i></button>
    </form>


    </div>
    <div>
   <p>Deine Daten:</p>
        <div class="box data-box">

        <?php
        for($i = 0; $i < count($userdata); $i++){
            echo "
            <div class='mb-2 data-box-item'>
                <span>". $userdata[$i]. "</span> 
                <span>
                <a class='ml-1' href='fileUploadService/$dataLocation[$i]'><i class='bi bi-folder2-open'></i></a>
                <a class='ml-1' href='fileUploadService/$dataLocation[$i]'download>"."<i class='bi bi-cloud-download-fill'></i></a>
                <a class='ml-1' href='fileDelete.php?delete=$userdataid[$i]'><i class='bi bi-file-earmark-x-fill'></i></a>
                </span>
            </div>";
        }
        ?>
            </div>
    </div>
    </div>
<?php
require_once ('space.php');
?>
</body>
</html>
<!--
Idee wenn man auf die Datei klickt dann soll sich das ganze Feld nach links bewegen und rechts sind dann einstellungen zu der DAtei
z.b. wie oft sie runtergeladen wurde wann etc. wie viele Bytes
-->

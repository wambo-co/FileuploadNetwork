<?php
session_start();
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');


use app\upload;
use app\getuserid;
use app\getuserdata;
use app\deleteUserData;

$userid = (new getuserid($_SESSION['username'], $mysqli))->getID();
$userdata = (new getuserdata($userid,2, $mysqli))->getData();
$userdataid = (new getuserdata($userid,0, $mysqli))->getData();
$dataLocation = (new getuserdata($userid, 4, $mysqli))->getData();
echo "insgesamt: ".(new getuserdata($userid,2, $mysqli))->getDataRange()." Daten wurden gefunden";

if($_SESSION['username'] == NULL){
    session_destroy();
    header("Location: ../login.php?loggedOut=sessionExpired");
}

if(isset($_POST['submit'])){
    session_destroy();
    header("Location: ../login.php?loginStatus=logout");
}





echo "<br>";
foreach ($userdata as $item){
   echo $item."</a><br>";

}
foreach ($dataLocation as $location){
    echo "<a href='fileUploadService/$location'download>Download</a>";
    echo "<a href='fileUploadService/$location'>Open</a>";
}


foreach ($userdataid as $item){
    echo "<a href='fileDelete.php?delete=$item'>Delete</a>".$item."<br>";

}
////

$username = $_SESSION['username'];
if(isset($_GET['upload'])){
    if($_GET['upload'] == "success"){
        $fileName = $_GET['fileName'];
        $fileSize = $_GET['fileSize'];
        $fileDestination = $_GET['fileDestination'];
        $fileUploadTime = $_GET['uploadTime'];

        echo $fileDestination." Destination<br>";
        echo $fileUploadTime." hochladedatum<br>";
        echo "Datei erfolgreich hochgeladen!";
       (new upload($userid, $fileName, $fileSize, $fileDestination, $fileUploadTime, $mysqli))->upload();
        header("Location: fileUpload.php");

    }else if($_GET['upload'] == "errorsize"){
        echo "Datei ist zu groß!";
    }else if($_GET['upload'] == "wrongtype"){
        echo "Falsche Datentyp!";
    }
}

?>
<html>
<head>
    <title>Private Space</title>
</head>
<body>
<form action="fileUploadService/upload.php" method="post" enctype="multipart/form-data"> <!-- damit können wir auch bilder verschicken durch die
php datei -->
    <input type="file" name="file" class="form-control-file"><br>
    <button type="submit" name="upload" class="btn btn-primary mt-2">Upload</button>
</form>
<a href="space.php">zurück</a>
<form action="" method="post">
    <button type="submit" name="submit">Ausloggen</button>
</form>
</body>
</html>

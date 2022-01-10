<?php
session_start();
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');


use app\upload;
use app\getuserid;
use app\getuserdata;
use app\deleteUserData;


// Check //
if($_SESSION['username'] == NULL){
    session_destroy();
    header("Location: ../login.php?loggedOut=sessionExpired");
}else{
    echo $_SESSION['username']." hat sich erfolreich eingeloggt";
}
if(isset($_POST['submit'])){
    session_destroy();
    header("Location: ../login.php?loginStatus=logout");
}

if(isset($_GET['upload'])){ // hochladen erfolgreich
    if($_GET['upload'] == "success"){
        echo "<br>Datei wurde erfolgreich hochgeladen</br>";
    }
}



if(isset($_GET['delete'])){
    $targetFile = $_GET['delete'];
   echo (new deleteUserData($targetFile, $mysqli))->delete();

}

$userid = (new getuserid($_SESSION['username'], $mysqli))->getID();
/*
 *         0=> 'id',
        1=> 'userid',
        2=> 'filename',
        3=> 'filesize',
        4=> 'date'
 */
$userdata = (new getuserdata($userid,2, $mysqli))->getData();
$userdataid = (new getuserdata($userid,0, $mysqli))->getData();

echo "insgesamt: ".(new getuserdata($userid,2, $mysqli))->getDataRange()." Daten wurden gefunden";
// userdata ist nun ein array userdata[0] erste datei zum beispiel





// liste der dateien eig nicht relevant bis auf die links
echo "<br>";
foreach ($userdata as $item){
    echo $item."<br>";
}

foreach ($userdataid as $item){
    echo "<a href='privateSpace.php?delete=$item'>Delete</a>".$item."<br>";

}
////



$username = $_SESSION['username'];
$file = $_POST['file'];
$fileSize = "0";
$fileUploadDate = "0";

// JETZT DAS MAN DIE DATEIEN AUCH HOCHLADEN KANN <---
if(isset($_POST['upload'])){
    (new upload($userid, $file, $fileSize, $fileUploadDate, $mysqli))->upload();




    header("Location: privateSpace.php?upload=success");

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
<a href="space.php">weiter</a>
<form action="" method="post">
    <input type="text" name="file">
    <button type="submit" name="upload">Upload new File</button>
    <button type="submit" name="submit">Ausloggen</button>
</form>
</body>
</html>

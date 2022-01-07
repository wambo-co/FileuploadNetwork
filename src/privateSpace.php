<?php
session_start();
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');



use app\upload;
use app\getuserid;
use app\getuserdata;

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

$id = (new getuserid($_SESSION['username'], $mysqli))->getID();
echo $id;

$userdata = (new getuserdata($id, $mysqli))->getData();
echo $userdata;

if(isset($_POST['upload'])){
    $newdata = $_POST['text'];
   // INSERT INTO userdata (userid, data) VALUES ('12', 'sfff');
    $command = "UPDATE `userdata` SET `data` = $newdata WHERE `userdata`.`userid` = $id";
    $mysqli->query($command);
}



?>
<html>
<head>
    <title>Private Space</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="text">
    <button type="submit" name="upload">Upload new File</button>
    <button type="submit" name="submit">Ausloggen</button>
</form>
</body>
</html>

<?php
require_once ('../sqlconnect.php');

session_start();

use app\upload;




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








$username = $_SESSION['username'];
$query = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$username'";
$result = mysqli_query($mysqli, $query);
$check = mysqli_fetch_array($result);
echo $check[0]; // nun habe ich die id

$id = $check[0];

$new = "SELECT * FROM `userdata` WHERE `userid` LIKE '$id';";
$res = mysqli_query($mysqli, $new);
$update = mysqli_fetch_array($res);
echo "<br>User daten:";
echo $update[1]."<br>";
$oldData = $update[1];

if(isset($_POST['upload'])){

    $newdata = $_POST['text'];
    $command = "UPDATE `userdata` SET `data` = '$oldData''$newdata' WHERE `userdata`.`userid` = $id";
    return $mysqli->query($command);
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

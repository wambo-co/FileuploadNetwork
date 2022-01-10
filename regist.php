<?php
require_once('vendor/autoload.php');
require_once('sqlconnect.php');

use app\register;
use app\isUsernameAvailable;

if(isset($_POST['submit'])){

    if((new isUsernameAvailable($_POST['username'], $mysqli))->check()){
        $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $mysqli);
        $regist->newUser();
        header("Location: login.php?loginStatus=newuser");

    }else{
        header("Location: regist.php?registrationStatus=userAlreadyAssigned");
    }
}
if(isset($_GET['registrationStatus'])){
    if($_GET['registrationStatus'] == "userAlreadyAssigned"){
        echo "Diesen Benutzer gibt es bereits. Bitte wähle einen anderen Namen aus!";
    }
}

?>

<html>
<head>
    <title>Registration</title>
</head>
<body>
<form action="regist.php" method="post">
    <label>Username: </label><input type="text" name="username" placeholder="username"><br>
    <label>Password: </label><input type="password" name="password" placeholder="password"><br>
    <label>E-mail: </label><input type="email" name="email" placeholder="youremail"><br>
    <button type="submit" name="submit">Register</button>
</form>
<a href="login.php">einloggen</a>
</body>
</html>







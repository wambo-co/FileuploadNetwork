<?php
require_once('vendor/autoload.php');
require_once('sqlconnect.php');

use app\test;
use app\register;

if(isset($_POST['submit'])){
    $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $mysqli);
    $regist->newUser();
    header("Location: login.php?loginStatus=newuser");
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







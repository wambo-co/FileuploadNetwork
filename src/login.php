<?php
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');
use app\login;

if(((new login($_POST['username'], $_POST['password'], $mysqli))->login())){
    session_start();
    $_SESSION['username'] = $_POST['username'];
    //header("Location: space.php?loginStatus=success");
    header("Location: fileUpload.php?loginStatus=success");

}else{
    header("Location: ../login.php?loginStatus=fail");
}
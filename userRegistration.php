<?php
require_once('vendor/autoload.php');
require_once('sqlconnect.php');

use app\register;
use app\userInformation;
?>
<html>
<head>
    <?php include ('elements/header.php'); ?>
    <title>Registration</title>
</head>
<body>
    <div class="is-vcentered has-text-centered">
        <div class="notification is-warning notification-box"><b>
                <?php
                if(isset($_POST['register'])){
                    $userInformation = new userInformation($_POST['username'], $mysqli);
                    if($userInformation->isUserAviable()){
                        $regist = new register($_POST['username'], $_POST['password'], $_POST['email'], $mysqli);
                        $regist->newUser();
                        header("Location: login.php?loginStatus=newuser");
                    }else{
                        header("Location: userRegistration.php?registrationStatus=userAlreadyAssigned");
                    }
                }
                if(isset($_GET['registrationStatus'])){
                    if($_GET['registrationStatus'] == "userAlreadyAssigned"){
                        echo "Diesen Benutzer gibt es bereits. Bitte wähle einen anderen Namen aus!";
                    }
                }
                ?></b></div>
    </div>

</body>
</html>







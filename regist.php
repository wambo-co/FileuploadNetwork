<?php
require_once('vendor/autoload.php');
require_once('sqlconnect.php');

use app\register;
use app\isUsernameAvailable;

?>
<html>
<head>
    <?php
    include ('elements/header.php');
    ?>
    <title>Registration</title>
</head>
<body>
<div class="is-vcentered has-text-centered ">
    <div class="notification is-warning notification-box"><b>
            <?php
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
            ?></b></div>
</div>
<form action="regist.php" method="post" class="box form-box">
    <div class="field">
        <label class="label">Username: </label><input class="input is-small" type="text" name="username">
    </div>
    <div class="field">
        <label class="label">Password: </label><input class="input is-small" type="password" name="password">
    </div>
    <div class="field">
        <label class="label">E-mail: </label><input class="input is-small" type="text" name="email">
    </div>
    <div class="field">
        <button class="button is-dark" type="submit" name="submit">Registrieren</button>
        <br>
        <b><u><a href="login.php" class="has-text-dark is-size-7">Du hast schon einen Account? Jetzt einloggen!</a></u><b>
    </div>
</form>
</body>
</html>







<html>
<head>
    <?php
    session_start();
    include ('elements/header.php');
    if(isset($_SESSION['username'])){
        header("Location: src/fileUpload.php");
    }
    ?>
</head>
<body>
    <div class="is-vcentered has-text-centered ">
        <div class="notification is-warning notification-box">
            <b>
                <?php
                if(isset($_GET['loggedOut'])){
                    if($_GET['loggedOut'] == "sessionExpired"){
                        echo "Sitzung abgelaufen!";}
                }else if(isset($_GET['loginStatus'])){
                    if($_GET['loginStatus'] == "fail"){
                        echo "Nutzer konnte nicht eingeloggt werden. Password oder Benutzername exisitiert nicht!";
                    }else if($_GET['loginStatus'] == "logout"){
                        session_destroy();
                        echo "Sitzung wurde beendet, Nutzer wurde erfolgreich ausgeloggt!";
                    }else if($_GET['loginStatus'] == "newuser"){
                        echo "Neuer Nutzer wurde erfolgreich angelegt, sie können sich jetzt einloggen";
                    }
                } ?>
            </b>
        </div>
    </div>
    <form action="src/login.php" method="post" class="box form-box">
        <div class="field">
            <label class="label">Username: </label><input class="input is-small" type="text" name="username" placeholder="username">
        </div>
        <div class="field">
            <label class="label">Password: </label><input class="input is-small" type="password" name="password" placeholder="password">
        </div>
        <div class="field">
            <button class="button is-dark" type="submit" name="submit">Einloggen</button>
            <br>
            <b><u><a href="userRegistration.php" class="has-text-dark is-size-7">Noch keinen Account? Jetzt registrieren!</a></u><b>
        </div>
    </form>
</body>
</html>
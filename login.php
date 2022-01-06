<?php
if(isset($_GET['loggedOut'])){
    if($_GET['loggedOut'] == "sessionExpired"){
        echo "Sitzung abgelaufen";
    }
}else if(isset($_GET['loginStatus'])){
    if($_GET['loginStatus'] == "fail"){
        echo "Nutzer konnte nicht eingeloggt werden. Password oder Benutzername exisitiert nicht!";
    }else if($_GET['loginStatus'] == "logout"){
        echo "Sitzung wurde beendet, Nutzer wurde erfolgreich ausgeloggt!";
    }else if($_GET['loginStatus'] == "newuser"){
        echo "Neuer Nutzer wurde erfolgreich angelegt, sie können sich jetzt einloggen";
    }
}
?>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="src/login.php" method="post">
        <label>Username: </label><input type="text" name="username"><br>
        <label>Password: </label><input type="password" name="password"><br>
        <button type="submit" name="submit">Einloggen</button>
    </form>
<a href="regist.php">
    Registrieren
</a>
</body>
</html>
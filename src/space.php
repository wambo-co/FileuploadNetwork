<?php
session_start();
if($_SESSION['username'] == NULL){
    session_destroy();
    header("Location: ../login.php?loggedOut=sessionExpired");
}



?>

<html>
<head>
    <title>Welcome</title>
</head>
<body>
Willkommen ! <?php echo $_SESSION['username']; ?>
<a href="fileUpload.php">Dateien hochladen</a>


</body>
</html>

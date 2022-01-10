<?php
session_start();
require_once ('../vendor/autoload.php');
require_once ('../sqlconnect.php');

use app\getuserid;
use app\getAccountInformation;

if($_SESSION['username'] == NULL){
    session_destroy();
    header("Location: ../login.php?loggedOut=sessionExpired");
}else{
    $username = $_SESSION['username'];
}


?>

<html>
<head>
    <title>Welcome</title>
</head>
<body>
Willkommen ! <?php echo $username ?>
<a href="fileUpload.php">Dateien hochladen</a>

<?php
$userSource = (new getAccountInformation($username, $mysqli))->getDataArray();
$userEmail =  $userSource[3];
$userPicture =  $userSource[4];
$userStatus = $userSource[5];
$userGroup = $userSource[6];
echo "<br>";
echo "Deine Email:".$userEmail."<br>";
echo "<img src='".$userPicture."'><br>";
echo "Status: ".$userStatus."<br>";
echo "Gruppe: ".$userGroup."<br>";



?>

</body>
</html>

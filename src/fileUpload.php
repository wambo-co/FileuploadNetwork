<?php
session_start();
require_once('../vendor/autoload.php');
use app\upload;
use app\userInformation;
use app\getUserData;
use app\storageController;
use app\convertUnit;
use app\MysqlConnection;


$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'uploadyourdata';

$connection = new MysqlConnection($db_host, $db_user,$db_password,$db_db);//

$username = $_SESSION['username'];


$userLoggedIn = new userInformation($_SESSION['username'], $connection->getMysqli());//
$userId = $userLoggedIn->getUserId();

$userFiles = new getUserData($userId, $mysqli);//
$userdata = $userFiles->getData();
$userdataid = $userFiles->getDataId();
$dataLocation = $userFiles->getDataLocation();
$dataUploadTime = $userFiles->getDataUploadTime();
$dataSize = $userFiles->getDataSize();
// Klassen mit einem Grpß buchstaben anfangen


?>
<html>
<head>
    <?php include('../elements/header.php'); ?>
    <title>Private Space</title>
</head>
<body>
    <div class='box'>
        <div class='is-vcentered has-text-centered '>
            <div class='notification is-warning notification-box'><b>
                    <?php
                    if($_SESSION['username'] == NULL){

                        session_destroy();
                        header("Location: ../login.php?loggedOut=sessionExpired");

                    }
                    if(isset($_POST['submit'])){

                        session_destroy();
                        header("Location: ../login.php?loginStatus=logout");
                    }
                    if(isset($_GET['delete'])){

                        echo "<br>Datei wurde erfolgreich gelöscht<br>";
                    }
                    if(isset($_GET['upload'])){

                        if($_GET['upload'] == "success"){
                            $fileName = $_GET['fileName'];
                            $fileSize = $_GET['fileSize'];
                            $fileDestination = $_GET['fileDestination'];
                            $fileUploadTime = $_GET['uploadTime'];

                            echo $fileDestination." Destination<br>";
                            echo $fileUploadTime." hochladedatum<br>";
                            echo "Datei erfolgreich hochgeladen!";
                            (new upload($userId, $fileName, $fileSize, $fileDestination, $fileUploadTime, $mysqli))->upload();
                            header("Location: fileUpload.php");

                        }else if($_GET['upload'] == "errorsize"){

                            echo "Datei ist zu groß!";

                        }else if($_GET['upload'] == "wrongtype"){

                            echo "Falsche Datentyp!";

                        }
                    }
                    ?>
                </b>
            </div>
        <form action='fileUploadService/fileUpload.php' method='post' enctype='multipart/form-data'>
            <input type='file' name='file' class='form-control-file'>
            <button type='submit' name='upload' class='button is-small is-light'>Hochladen</button>
            <button class='button is-small ' onclick='window.open('userInfo.php')'><i class='bi bi-person-fill'></i></button>
            <button  name='submit' class='button is-small' onclick='window.open('../login.php?loginStatus=logout')'><i class='bi bi-box-arrow-right'></i></button>
        </form>
        </div>
        <div>
            <p>Deine Daten:</p>
            <div class='box data-box'>
                <?php
                for($i = 0; $i < count($userdata); $i++){
                    $fileConverter = new convertUnit($dataSize[$i]);
                    $newDataSize = $fileConverter->convertToMb();
                    echo "
                        <div class='mb-2 data-box-item'>
                        <div>
                        <span>". $userdata[$i]. "</span> 
                        </div>
                        <div>
                        <span>". $newDataSize." MB</span>   
                        <a class='ml-1' href='fileUploadService/$dataLocation[$i]'><i class='bi bi-folder2-open'></i></a>
                        <a class='ml-1' href='fileUploadService/$dataLocation[$i]'download>"."<i class='bi bi-cloud-download-fill'></i></a>
                        <a class='ml-1' href='fileUploadService/fileDelete.php?delete=$userdataid[$i]&fileSize=$dataSize[$i]'><i class='bi bi-file-earmark-x-fill'></i></a>
                        </div>
                        </span>
                    </div>";

                }
                ?>
            </div>
        </div>
    </div>
    <?php require('userInfo.php'); ?>
</body>

</html>

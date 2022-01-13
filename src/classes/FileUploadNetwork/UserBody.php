<?php

namespace fileUploadNetwork;

class UserBody
{
    public $mysqlConnection;
    public $username;
    public UserInformation $userInformation;
    public GetUserData $getUserData;


    public function __construct($mysqlConnection)
    {
     $this->mysqlConnection = $mysqlConnection;
    }

    public function generateBody() : string
    {
        if($_SESSION['username'] == NULL){
            session_destroy();
        }
        $bodyGeneratedHtml = " 
        <div class='box'>
        <div class='is-vcentered has-text-centered '>
        <div class='notification is-warning notification-box'><b>
        <form action='index.php' method='post'>
        <button name='submit' type='submit'>Logout</button>
        </form>
        ";
        return $bodyGeneratedHtml;
    }



    public function handleRequestRichtig() : string
    {
        if($_SESSION['username'] == NULL){
            session_destroy();
        }
        if(isset($_POST['submit'])){
            session_destroy();
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
    }

}
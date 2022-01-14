<?php

namespace UserPage;
use FileService\DeleteUserData;
use FileService\UploadUserFile;
use Controller\ViewController;
use Controller\StorageController;
use Converter\ConvertUnit;
use Main\LoginBody;
use FileService\GetUserData;
use UserPage\UserInformation;



class UserBody
{
    public $mysqlConnection;
    public LoginBody $loginBody;

    public function __construct($mysqlConnection, $loginBody)
    {
     $this->mysqlConnection = $mysqlConnection;
     $this->loginBody = $loginBody;
    }

    public function routingInsideUserSite()
    {
        // ='index.php?delete=$userdataid[$i]&fileSize=$dataSize[$i]'><i class='bi bi-file-earma
        if(isset($_GET['delete'])){
            $fileId = $_GET['delete'];
            $fileSize = $_GET['fileSize'];
            $fileService = new DeleteUserData($this->mysqlConnection, $fileId, $fileSize);
            $fileService->deleteFileOnServerSpace();
            return $this->generateBody();

        }else if(isset($_POST['upload'])){
            $userId = $this->getUserId();

            $fileService = new UploadUserFile(
                $_FILES['file'],
                [
                    "jpg",
                    "java",
                    "pdf",
                    "zip"
                ],
                "100000000000",
                "uploads",
            "Ist zuuuu groß",
            "falscher typ",
            "wurde erfolgreich hochgeladen",
            $userId,$this->mysqlConnection);
            $fileService->upload();
            return $this->generateBody();

        }else if(isset($_POST['logout'])){
            session_destroy();
            return $this->loginBody->generateBody();

        }else{
            return $this->generateBody();

        }
    }

    public function getUserId()
    {
        $userLoggedIn = new UserInformation($_SESSION['username'], $this->mysqlConnection);
        $userId = $userLoggedIn->getUserId();
        return $userId;
    }

    public function generateBody()
    {
        $userId = $this->getUserId();
        $userFiles = new getUserData($userId, $this->mysqlConnection);
        $userdata = $userFiles->getData();
        $userdataid = $userFiles->getDataId();
        $dataLocation = $userFiles->getDataLocation();
        $dataUploadTime = $userFiles->getDataUploadTime();
        $dataSize = $userFiles->getDataSize();

        $loadUserStorage = new storageController(
        $_SESSION['username'],
            0,0,
            $this->mysqlConnection
            );


        $userStorageSpace = (new convertUnit($loadUserStorage->getUserFullSpace()))->convertToMb();
        $userUsedStorageSpace =(new convertUnit($loadUserStorage->getUserActualSpaceUsage()))->convertToMb();
        $userUsedStoragePercent = $loadUserStorage->getUserUsedSpaceInPercent($userStorageSpace,$userUsedStorageSpace);


        $bodyGeneratedHtml = "
        <div class='user-UI'>
        <form action='../../../index.php' method='post' enctype='multipart/form-data'>
            <input type='file' name='file' class='form-control-file'>
            <button type='submit' name='upload' class='button is-small is-light'>Hochladen</button>
            <button class='button is-small ' onclick='window.open('userInfo.php')'><i class='bi bi-person-fill'></i></button>
            <button  name='logout' class='button is-small'><i class='bi bi-box-arrow-right'></i></button>
        </form>
          <progress class='progress'  value='$userUsedStoragePercent' max='100'></progress>
                    Du hast bereits $userUsedStorageSpace MB von $userStorageSpace
                    MB verbraucht.
                    <br>
        <p>Meine Daten</p>
        <div class='box data-box'>";
                   for($i = 0; $i < count($userdata); $i++){
                    $fileConverter = new convertUnit($dataSize[$i]);
                    $newDataSize = $fileConverter->convertToMb();
                    $bodyGeneratedHtml .= "
                    <div class='mb-2 data-box-item'>
                        <div>
                            <span>". $userdata[$i]. "</span> 
                        </div>
                        <div>
                            <span>". $newDataSize." MB</span>   
                            <a class='ml-1' href='$dataLocation[$i]'><i class='bi bi-folder2-open'></i></a>
                            <a class='ml-1' href='$dataLocation[$i]'download>"."<i class='bi bi-cloud-download-fill'></i></a>
                            <a class='ml-1' href='index.php?delete=$userdataid[$i]&fileSize=$dataSize[$i]'><i class='bi bi-file-earmark-x-fill'></i></a>
                        </div>              
                    </div>";
                    }
        return $bodyGeneratedHtml;
    }

}

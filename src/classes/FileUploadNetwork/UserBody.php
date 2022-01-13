<?php

namespace fileUploadNetwork;
use fileUploadNetwork\FileService;


class UserBody
{
    public $mysqlConnection;

    public function __construct($mysqlConnection)
    {
     $this->mysqlConnection = $mysqlConnection;
    }

    public function routingInsideUserSite()
    {
        if(isset($_GET['delete'])){
            $fileId = $_GET['delete'];
            $fileSize = $_GET['fileSize'];
            $fileService = new FileService($this->mysqlConnection, $fileId, $fileSize);
            $fileService->deleteFile();
        }else if(isset($_POST['upload'])){

        }
    }

    public function generateBody()
    {
        $this->routingInsideUserSite();

        $userLoggedIn = new userInformation($_SESSION['username'], $this->mysqlConnection);
        $userId = $userLoggedIn->getUserId();
        var_dump($userId);
        $userFiles = new getUserData($userId, $this->mysqlConnection);
        $userdata = $userFiles->getData();
        $userdataid = $userFiles->getDataId();
        $dataLocation = $userFiles->getDataLocation();
        $dataUploadTime = $userFiles->getDataUploadTime();
        $dataSize = $userFiles->getDataSize();

        // Generate Html Code
        $bodyGeneratedHtml = " 
        <div class='box'>
                <div class='is-vcentered has-text-centered '>
                    <div class='notification is-warning notification-box'>
                        <b><a href='index.php?logout=true'><button type='submit'>logout</button></a></b>
                </div>
                
            </div>
        </div>       
        ";
        $bodyGeneratedHtml .="
        <form action='index.php' method='post' enctype='multipart/form-data'>
            <input type='file' name='file' class='form-control-file'>
            <button type='submit' name='upload' class='button is-small is-light'>Hochladen</button>
            <button class='button is-small ' onclick='window.open('userInfo.php')'><i class='bi bi-person-fill'></i></button>
            <button  name='submit' class='button is-small' onclick='window.open('../login.php?loginStatus=logout')'><i class='bi bi-box-arrow-right'></i></button>
        </form>
        </div>
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
                            <a class='ml-1' href='uploads/$dataLocation[$i]'><i class='bi bi-folder2-open'></i></a>
                            <a class='ml-1' href='uploads/$dataLocation[$i]'download>"."<i class='bi bi-cloud-download-fill'></i></a>
                            <a class='ml-1' href='index.php?delete=$userdataid[$i]&fileSize=$dataSize[$i]'><i class='bi bi-file-earmark-x-fill'></i></a>
                        </div>              
                    </div>";
                    }
        return $bodyGeneratedHtml;
    }

    public function showUserFiles()
    {
        $generateUserFilesHtml = "<div class='box data-box'>";

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
                            <a class='ml-1' href='uploads/$dataLocation[$i]'><i class='bi bi-folder2-open'></i></a>
                            <a class='ml-1' href='uploads/$dataLocation[$i]'download>"."<i class='bi bi-cloud-download-fill'></i></a>
                            <a class='ml-1' href='index.php?delete=$userdataid[$i]&fileSize=$dataSize[$i]'><i class='bi bi-file-earmark-x-fill'></i></a>
                        </div>              
                    </div>";
        }


    }
}

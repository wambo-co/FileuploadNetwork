<?php

namespace fileUploadNetwork;
use mysqli;

class UserSiteBody
{
    public mysqli $mysqlConnection;
    public string $activeUsername;
    public string $postFileSuccessfullyDeleted;
    public string $postFileSuccessfullyUploaded;
    public string $postFileSizeToBig;
    public string $postWrongFileType;
    public string $buttonUpload;
    public string $textYourData;

    public function __construct($mysqlConnection, $activeUsername, $postFileSuccessfullyDeleted, $postFileSuccessfullyUploaded, $postFileSizeToBig, $postWrongFileType, $buttonUpload, $textYourData)
    {
        $this->mysqlConnection = $mysqlConnection;
        $this->activeUsername = $activeUsername;
        $this->postFileSuccessfullyDeleted = $postFileSuccessfullyDeleted;
        $this->postFileSuccessfullyUploaded = $postFileSuccessfullyUploaded;
        $this->postFileSizeToBig = $postFileSizeToBig;
        $this->postWrongFileType = $postWrongFileType;
        $this->buttonUpload = $buttonUpload;
        $this->textYourData = $textYourData;
    }

    public function generateBody() :string
    {
        $userLoggedIn = new userInformation($_SESSION['username'], $this->mysqlConnection);
        $userId = $userLoggedIn->getUserId();

        $userFiles = new getUserData($userId, $this->mysqlConnection);
        $userdata = $userFiles->getData();
        $userdataid = $userFiles->getDataId();
        $dataLocation = $userFiles->getDataLocation();
        $dataUploadTime = $userFiles->getDataUploadTime();
        $dataSize = $userFiles->getDataSize();


        $bodyGeneratedHtml = "
         <div class='box'>
            <div class='is-vcentered has-text-centered '>
                <div class='notification is-warning notification-box'><b>";
                    if($_SESSION['username'] == NULL){
                        session_destroy();
                        header("Location: index.php?loggedOut=sessionExpired");
                        //vorher login.php

                    }
                    if(isset($_POST['submit'])){
                        session_destroy();
                        header("Location: index.php?loginStatus=logout");
                        //vorher login
                    }
                    if(isset($_GET['delete'])){
                        $bodyGeneratedHtml .= $this->postFileSuccessfullyDeleted;
                    }
                    if(isset($_GET['upload'])){

                        if($_GET['upload'] == "success"){
                            $fileName = $_GET['fileName'];
                            $fileSize = $_GET['fileSize'];
                            $fileDestination = $_GET['fileDestination'];
                            $fileUploadTime = $_GET['uploadTime'];

                            echo $fileDestination." Destination<br>";
                            echo $fileUploadTime." hochladedatum<br>";
                            echo $this->postFileSuccessfullyUploaded;
                            $userId = new UserInformation($this->activeUsername, $this->mysqlConnection);
                            $userId = $userId->getUserId();
                            (new upload($userId, $fileName, $fileSize, $fileDestination, $fileUploadTime, $this->mysqlConnection))->upload();
                            header("Location: fileUpload.php");

                        }else if($_GET['upload'] == "errorsize"){

                            $bodyGeneratedHtml .=  $this->postFileSizeToBig;

                        }else if($_GET['upload'] == "wrongtype"){

                            $bodyGeneratedHtml .=  $this->postWrongFileType;

                        }
                    }// vorher war er uploadservice/upload.php
         $bodyGeneratedHtml .= "</b></div>
          <form action='index.php' method='post' enctype='multipart/form-data'>
            <input type='file' name='file' class='form-control-file'>
            <button type='submit' name='upload' class='button is-small is-light'>".$this->buttonUpload."</button>
            <button class='button is-small ' onclick=''><i class='bi bi-person-fill'></i></button>
            <button  name='submit' class='button is-small' onclick='window.open(`index.php?loginStatus=logout`)'><i class='bi bi-box-arrow-right'></i></button>
           </form>
        </div>
        <div>
            <p>".$this->textYourData."</p>
            <div class='box data-box'>";
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
                    </div>
                  </div>
                </div>
            </div>";

        }
                    return $bodyGeneratedHtml;

    }


}
<?php

namespace FileService;
use FileService\Upload;
use Controller\StorageController;
class UploadUserFile
{
    public $file;
    public $allowedTypes= [];
    public $allowedSizePerFile;
    public $uploadLocation;
    public $textFileSuccessfullyUploaded;
    public $textFileToBig;
    public $textWrongFileType;
    public $mysqlConnection;
    public $userid;

    public function __construct($file, $allowedTypes, $allowedSizePerFile,
                                $uploadLocation, $textFileToBig, $textWrongFileType,
                                $textFileSuccessfullyUploaded, $userid, $mysqlConnection)
    {
        $this->file = $file;
        $this->allowedTypes = $allowedTypes;
        $this->allowedSizePerFile = $allowedSizePerFile;
        $this->uploadLocation = $uploadLocation;
        $this->textFileToBig = $textFileToBig;
        $this->textWrongFileType = $textWrongFileType;
        $this->textFileSuccessfullyUploaded = $textFileSuccessfullyUploaded;
        $this->userid = $userid;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function upload()
    {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTMP = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $allowed = $this->allowedTypes;
        $allowedFileSize = $this->allowedSizePerFile;
        $uploadTime = date("F j, Y, g:i a");

        if(in_array($fileExt[1], $allowed)){
           if($fileError == 0){
               if($fileSize < $allowedFileSize){

                    $new_file_name = uniqid('', true).".".$fileExt[1];
                    $fileDestination = "$this->uploadLocation/$new_file_name";
                    move_uploaded_file($fileTMP, $fileDestination);
                    //hier noch increaseStorageAmount
                    $connect = new Upload($this->userid, $fileName, $fileSize, $fileDestination, $uploadTime, $this->mysqlConnection);
                    $connect->addToDatabase();
                    $addSpace = new StorageController($_SESSION['username'], $fileSize, "", $this->mysqlConnection);
                    $addSpace->increaseUserStorageAmount();
                    return $this->textFileSuccessfullyUploaded;
                }else{
                    return $this->textFileToBig;
                }
            }else{
                return $fileError;
            }
        }else{
            return "fehler";
        }
    }
}

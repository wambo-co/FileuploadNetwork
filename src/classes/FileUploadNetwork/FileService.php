<?php

namespace fileUploadNetwork;
use fileUploadNetwork\DeleteUserData;
use fileUploadNetwork\StorageController;
use fileUploadNetwork\UploadUserData;


class FileService
{
    protected $mysqlConnection;
    protected int $fileId;
    protected int $fileSize;


    public function __construct($mysqlConnection, $fileId, $fileSize)
    {
        $this->mysqlConnection = $mysqlConnection;
        $this->fileId = $fileId;
        $this->fileSize = $fileSize;
    }

    public function deleteFile()
    {
      $file = new DeleteUserData($this->mysqlConnection,$this->fileId, $this->fileSize);
      $file->deleteFileOnServerSpace();
    }

    public function startUploadingFileservice()
    {


    }
}
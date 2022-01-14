<?php

namespace fileUploadNetwork;
use fileUploadNetwork\StorageController;


class DeleteUserData
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

    public function deleteFileOnServerSpace()
    {
        $query = "SELECT `filelocation` FROM `userfiles` WHERE `id` = $this->fileId;";
        $res = mysqli_query($this->mysqlConnection, $query);
        $check = mysqli_fetch_array($res);
        $deleteLocation = "$check[0]";
        unlink($deleteLocation);

        $deleteSpace = new StorageController($_SESSION['username'],"" , $this->fileSize, $this->mysqlConnection);
        $deleteSpace->reduceUserStorageAmount();

        $this->deleteFileFromDatabase();
        //$this->reduceSpace();
    }

    public function deleteFileFromDatabase()
    {
        $command = "DELETE FROM `userfiles` WHERE `userfiles`.`id` = $this->fileId;";
        return $this->mysqlConnection->query($command);
    }

    public function reduceSpace() :bool
    {
        $reduceSpace = new storageController($_SESSION['username'], "", $this->fileSize,$this->mysqlConnection);
        $reduceSpace->reduceUserStorageAmount();
        return true;
    }

}


//DELETE FROM `userfiles` WHERE `userfiles`.`id` = 50;
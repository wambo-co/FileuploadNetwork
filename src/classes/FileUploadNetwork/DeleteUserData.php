<?php

namespace fileUploadNetwork;
use fileUploadNetwork\StorageController;

class DeleteUserData extends FileService
{

    public function deleteFileOnServerSpace()
    {
        $query = "SELECT `filelocation` FROM `userfiles` WHERE `id` = $this->fileId;";
        $res = mysqli_query($this->mysqlConnection, $query);
        $check = mysqli_fetch_array($res);
        $deleteLocation = "uploads/".$check[0];
        unlink($deleteLocation);
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
<?php

namespace Controller;

class StorageController
{
    public $username;
    public  $newUploadFileSize;
    public  $deleteFileSize;
    public  $mysqlConnection;


    public function __construct($username, $newUploadFileSize, $deleteFileSize, $mysqlConnection)
    {
        $this->username = $username;
        $this->newUploadFileSize = $newUploadFileSize;
        $this->deleteFileSize = $deleteFileSize;
        $this->mysqlConnection = $mysqlConnection;
    }


    public function getUserFullSpace()
    {
        $command = "SELECT `normalUserSpace` FROM `administration`";
        $res = $this->mysqlConnection->query($command);
        $space = mysqli_fetch_all($res);
        return $space[0][0];
    }


    public function getUserActualSpaceUsage()
    {
        $query = "SELECT `normalUserSpace` FROM `administration`";
        $result = $this->mysqlConnection->query($query);
        $fullSpace = mysqli_fetch_all($result);

        $command = "SELECT `storageSpace` FROM `useraccounts` WHERE `username` = '$this->username'";
        $res = $this->mysqlConnection->query($command);
        $space = mysqli_fetch_all($res);

        return ($fullSpace[0][0]-($fullSpace[0][0] - $space[0][0]));

    }


    public function getUserUsedSpaceInPercent($fullSpace, $usedSpace)
    {
        return ($usedSpace / $fullSpace)*100;
    }


    public function reduceUserStorageAmount()
    {
        $command = "UPDATE `useraccounts` SET `storageSpace` = `storageSpace` - $this->deleteFileSize WHERE `username` = '$this->username'";
        $res = $this->mysqlConnection->query($command);
        return $res;
    }

    public function increaseUserStorageAmount()
    {
        $command = "UPDATE `useraccounts` SET `storageSpace` = `storageSpace` + $this->newUploadFileSize WHERE `username` = '$this->username'";
        $res = $this->mysqlConnection->query($command);
        return $res;
    }

}
<?php

namespace app;

class deleteUserData
{
    protected $targetFile;
    protected $mysqlConnection;

    public function __construct($targetFile, $mysqlConnection)
    {
        $this->targetFile = $targetFile;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function delete()
    {
        $command = "DELETE FROM `userfiles` WHERE `userfiles`.`id` = $this->targetFile;";
         return $this->mysqlconnection->query($command);
    }

}


//DELETE FROM `userfiles` WHERE `userfiles`.`id` = 50;
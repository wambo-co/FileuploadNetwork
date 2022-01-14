<?php

namespace FileService;
use Controller\StorageController;

class Upload
{
    protected $userid;
    protected $file;
    protected $fileSize;
    protected $date;
    protected $fileLocation;
    protected $mysqlconnection;



    public function __construct($userid, $file, $fileSize, $fileLocation,$date,  $mysqlconnection)
    {
        $this->userid = $userid;
        $this->file = $file;
        $this->fileSize = $fileSize;
        $this->date = $date;
        $this->fileLocation = $fileLocation;
        $this->mysqlconnection = $mysqlconnection;
    }

    public function addToDatabase()
    {
        $command = "
        INSERT INTO `userfiles` (`id`, `userid`, `filename`, `filesize`, `filelocation`, `date`)
        VALUES (NULL, '$this->userid', '$this->file','$this->fileSize','$this->fileLocation', '$this->date');";
        return $this->mysqlconnection->query($command);
    }



}
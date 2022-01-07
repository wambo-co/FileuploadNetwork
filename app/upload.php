<?php

namespace app;

class upload
{
    protected $userid;
    protected $file;
    protected $fileSize;
    protected $date;
    protected $mysqlconnection;


    public function __construct($userid, $file, $fileSize, $date, $mysqlconnection)
    {
        $this->userid = $userid;
        $this->file = $file;
        $this->fileSize = $fileSize;
        $this->date = $date;
        $this->mysqlconnection = $mysqlconnection;
    }

    public function upload()
    {
        $command = "INSERT INTO `userfiles` (`id`, `userid`, `filename`, `filesize`, `date`) VALUES (NULL, '$this->userid', '$this->file','$this->fileSize', '$this->date');";
        return $this->mysqlconnection->query($command);
    }

}
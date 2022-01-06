<?php

namespace app;

class upload
{
    protected $id;
    protected $currentfile;
    protected $file;
    protected $mysqlconnection;


    public function __construct($id, $currentfile,$file, $mysqlconnection)
    {
        $this->id = $id;
        $this->file = $file;
        $this->mysqlconnection = $mysqlconnection;
        $this->currentfile = $currentfile;
    }


    public function upload()
    {

       return $this->mysqlconnection->query("UPDATE `userdata` SET `data` = 'test' WHERE `userdata`.`userid` = $this->id");
    }

}
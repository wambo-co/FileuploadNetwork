<?php

namespace app;

class getuserdata
{
    protected $id;
    protected $mysqlConnection;

    public function __construct($id, $mysqlConnection)
    {
        $this->id = $id;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function getData()
    {
        $command = "SELECT * FROM `userdata` WHERE `userid` LIKE '$this->id';";
        $res = mysqli_query($this->mysqlConnection, $command);
        return mysqli_fetch_array($res)[1];
    }


}
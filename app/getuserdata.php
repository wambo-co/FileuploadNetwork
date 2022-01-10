<?php

namespace app;

class getuserdata
{
    protected $userid;
    protected $mysqlConnection;

    public function __construct($userid, $mysqlConnection)
    {
        $this->userid = $userid;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function getData()
    {
        $command = "SELECT * FROM `userfiles` WHERE `userid` = $this->userid";
        $res = mysqli_query($this->mysqlConnection, $command);
        $result =  mysqli_fetch_all($res);
        $calledData = [];
        for($i=0; $i < count($result); $i++){
            $calledData[] = $result[$i][2];
        }
        return $calledData;
    }
    public function getDataId()
    {
        $command = "SELECT * FROM `userfiles` WHERE `userid` = $this->userid";
        $res = mysqli_query($this->mysqlConnection, $command);
        $result =  mysqli_fetch_all($res);
        $calledData = [];
        for($i=0; $i < count($result); $i++){
            $calledData[] = $result[$i][0];
        }
        return $calledData;
    }

    public function getDataLocation()
    {
        $command = "SELECT * FROM `userfiles` WHERE `userid` = $this->userid";
        $res = mysqli_query($this->mysqlConnection, $command);
        $result =  mysqli_fetch_all($res);
        $calledData = [];
        for($i=0; $i < count($result); $i++){
            $calledData[] = $result[$i][4];
        }
        return $calledData;
    }


    public function getDataRange()
    {
        $command = "SELECT * FROM `userfiles` WHERE `userid` = $this->userid";
        $res = mysqli_query($this->mysqlConnection, $command);
        $result =  mysqli_fetch_all($res);
        return count($result);
    }

}
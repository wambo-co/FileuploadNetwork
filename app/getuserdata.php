<?php

namespace app;

class getuserdata
{
    protected $userid;
    protected $column;
    protected $mysqlConnection;

    public function __construct($userid, $column, $mysqlConnection)
    {
        $this->userid = $userid;
        $this->mysqlConnection = $mysqlConnection;
        $this->column = $column;
    }

    public function getData()
    {
    // einbauen das man etwas true machen kann also die columns

        $command = "SELECT * FROM `userfiles` WHERE `userid` = $this->userid";
        $res = mysqli_query($this->mysqlConnection, $command);
        $result =  mysqli_fetch_all($res);
        $calledData = [];

        for($i=0; $i < count($result); $i++){
         //   return $result[$i][$this->column]."<br>";
            $calledData[] = $result[$i][$this->column];
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
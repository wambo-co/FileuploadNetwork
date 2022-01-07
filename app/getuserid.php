<?php

namespace app;

class getuserid
{
    protected $username;
    protected $mysqlConnection;

    public function __construct($username, $mysqlConnection)
    {
        $this->username = $username;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function getID()
    {
        $command = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$this->username';";
        $res = mysqli_query($this->mysqlConnection, $command);
        $useraccountsDB = mysqli_fetch_array($res);
        return $useraccountsDB[0];

    }


}
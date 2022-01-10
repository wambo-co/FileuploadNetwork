<?php

namespace app;

class getAccountInformation
{
    protected $username;
    protected $mysqlConnection;

    public function __construct($username, $mysqlConnection)
    {
        $this->username = $username;
        $this->mysqlConnection = $mysqlConnection;
    }


    public function getDataArray()
    {
        $query = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$this->username'";
        $result = mysqli_query($this->mysqlConnection, $query);
        $check = mysqli_fetch_array($result);
        return $check;
    }

}
<?php

namespace app;

class isUsernameAvailable
{
    protected $username;
    protected $mysqlConnection;

    public function __construct($username, $mysqlConnection)
    {
        $this->username = $username;
        $this->mysqlConnection = $mysqlConnection;
    }
    
    public function check()
    {
        $query = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$this->username'";
        $result = mysqli_query($this->mysqlConnection, $query);
        $check = mysqli_fetch_array($result);
        if($check != NULL){
            return false;
        }else{
            return true;
        }

    }

}
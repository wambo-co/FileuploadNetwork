<?php

namespace UserPage;

class UserInformation implements userInformationInterface
{
    protected $username;
    protected $mysqlConnection;


    public function __construct($username, $mysqlConnection)
    {
        $this->username = $username;
        $this->mysqlConnection = $mysqlConnection;
    }


    public function isUserAviable()
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


    public function getUserId()
    {
        $command = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$this->username';";
        $res = mysqli_query($this->mysqlConnection, $command);
        $useraccountsDB = mysqli_fetch_array($res);
        return $useraccountsDB[0];
    }


    public function getUserAccountInformation()
    {
        $query = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$this->username'";
        $result = mysqli_query($this->mysqlConnection, $query);
        $check = mysqli_fetch_array($result);
        return $check;
    }
}
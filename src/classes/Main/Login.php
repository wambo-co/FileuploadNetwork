<?php

namespace loginpage;

class Login
{
    protected $username;
    protected $password;
    protected $mysqlConnection;


    public function __construct($username, $password , $mysqlConnection)
    {
        $this->password = $password;
        $this->username = $username;
        $this->mysqlConnection = $mysqlConnection;
    }



    public function login()
    {
        // new ist das was ich aus der datenbank bekomme
        $query = "SELECT * FROM `useraccounts` WHERE `username` LIKE '$this->username'";
        $result = mysqli_query($this->mysqlConnection, $query);
        $check = mysqli_fetch_array($result);
        if(password_verify($this->password, $check[2])) {
            return true;
        }else{
            return false;
        }
    }

}


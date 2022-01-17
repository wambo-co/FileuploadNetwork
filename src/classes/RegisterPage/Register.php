<?php

namespace Registerpage;


class Register
{
    protected $name;
    protected $password;
    protected $email;
    protected $mysqlconnection;


    public function __construct($name, $password, $email, $mysqlconnection)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->mysqlconnection = $mysqlconnection;
    }


    public function newUser()
    {
        $createHashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $cmd = "INSERT INTO `useraccounts` (`ID`, `username`, `password`, `email`, `userpicture`, `userstatus`, `usergroup`, `storageSpace`) VALUES (NULL, '$this->name', '$createHashPassword', '$this->email', '-', '-', '-' , '0'); ";
        $this->mysqlconnection->query($cmd);
    }


}
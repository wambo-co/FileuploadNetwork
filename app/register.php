<?php

namespace app;


class register
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
    /*
    public function newUser()
    {
        $createHashPassword = password_hash($this->password, PASSWORD_DEFAULT);
       return $this->mysqlconnection->query("INSERT INTO `useraccounts` (`ID`, `username`, `password`, `email`) VALUES (NULL, '$this->name', '$createHashPassword', '$this->email')");
    }*/
    public function newUser()
    {

        $createHashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $cmd = "INSERT INTO `useraccounts` (`ID`, `username`, `password`, `email`, `userpicture`, `userstatus`, `usergroup`) VALUES (NULL, '$this->name', '$createHashPassword', '$this->email', '-', '-', '-' ); ";
        $this->mysqlconnection->query($cmd);
        // INSERT INTO `userfiles` (`username`, `files`, `groups`, `extra`) VALUES ('$this->name', '-', '-', '-')";
    }


}
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
    public function newUser()
    {
        $createHashPassword = password_hash($this->password, PASSWORD_DEFAULT);
       return $this->mysqlconnection->query("INSERT INTO `useraccounts` (`ID`, `username`, `password`, `email`) VALUES (NULL, '$this->name', '$createHashPassword', '$this->email')");
    }

    public function newUser2()
    {
        $createHashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->mysqlconnection->query("INSERT INTO `useraccounts` (`ID`, `username`, `password`, `email`) VALUES (NULL, '$this->name', '$createHashPassword', '$this->email');");

        $this->getID($this->name, $this->mysqlconnection);


        // wir brauchen die ID um ein neues Space zu erstellen
        //-> Space erstellen

    }

// Beim registieren muss eine neue Space eingerichtet werden!

}
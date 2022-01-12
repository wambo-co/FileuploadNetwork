<?php

namespace fileUploadNetwork;

use mysqli;

class MysqlConnection
{
    private string $host;
    private string $user;
    private string $password;
    private string $database;


    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    public function getMysqli() :mysqli
    {
        return $this->mysqli;
    }

    private function connect()
    {

        $this->mysqli = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database,
        );
    }

}
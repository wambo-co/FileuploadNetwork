<?php

namespace app;

interface userInterface
{
    public function isUserAviable($username, $mysqlConnection);
    public function getUserId($username, $mysqlConnection);
    public function getUserAccountInformation($username, $mysqlConnection);
    public function loginUser($username, $password, $mysqlConnection);
    public function createNewUser($username, $password, $email, $mysqlConnection);
}
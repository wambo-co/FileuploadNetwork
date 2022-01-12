<?php

namespace fileUploadNetwork;

interface UserInformationInterface
{
    public function __construct($username, $mysqlConnection);
    public function isUserAviable();
    public function getUserId();
    public function getUserAccountInformation();
}
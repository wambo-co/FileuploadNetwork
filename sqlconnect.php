<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'uploadyourdata';

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    exit();
}

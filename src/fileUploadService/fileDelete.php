<?php
session_start();
require_once('../../vendor/autoload.php');
require_once('../../sqlconnect.php');

use app\deleteUserData;
use app\storageController;



$query = "SELECT `filelocation` FROM `userfiles` WHERE `id` = $dataId;";
$res = mysqli_query($mysqli, $query);
$check = mysqli_fetch_array($res);
$deleteLocation = "fileUploadService/".$check[0];
echo $deleteLocation;

unlink($deleteLocation);

$deleteFile = new deleteUserData($_GET['delete'], $mysqli);
$deleteFile->delete();


$reduceSpace = new storageController($_SESSION['username'], "", $fileSize, $mysqli);
$reduceSpace->reduceUserStorageAmount();


header("Location: ../fileUpload.php?delete=success");

<?php

namespace Controller;

class StorageController
{
    //TODO: info wie viel zur verfügung , wie viel verbraucht
    // Wenn man eine Datei hochlädt dann soll er die Dateigröße abziehen
    // und den Speicher anzeigen , falls der speicher voll ist soll er die Datei nicht hochladen sondern eine
    // Fehlermeldung anzeigen
    // Progressbar sollte sich danach richten

    // In welcher Datei wird die Klasse verwendet:
    // userRegistration.php , fileUpload.php , userInfo.php und Serve FileUpload.php

    /*
     *
     * $userStorageSpace = "10 GB";
        $userFreeStorageSpace = "1024 MB";
        $userUsedStorageSpace = "10 MB";
        $userUsedStoragePercent = "30";
     */


    public $username; // um zu gucken wie viel Speicher der user zur verfügung hat
    public  $newUploadFileSize; // neue Dateigröße ermitteln um diese dann abzuziehen
    public  $deleteFileSize; // um die Datei wieder zu löschen
    public  $mysqlConnection;

    public function __construct($username, $newUploadFileSize, $deleteFileSize, $mysqlConnection)
    {
        $this->username = $username;
        $this->newUploadFileSize = $newUploadFileSize;
        $this->deleteFileSize = $deleteFileSize;
        $this->mysqlConnection = $mysqlConnection;
    }

    public function isSpaceEnough() //:bool
    {
        /*TODO:
        Wenn aktuller Speicher + neuer Speicherdatei > getUserFullSpace
            Dann return false;
        Sonst
            return true
        */

    }

    public function getUserFullSpace() // Gesamter Speicher der zur Verfügung steht
    {
        //SELECT `storageSpace` FROM `useraccounts` WHERE `username` = 'asd'
        $command = "SELECT `normalUserSpace` FROM `administration`";
        $res = $this->mysqlConnection->query($command);
        $space = mysqli_fetch_all($res);
        return $space[0][0];
    }

    public function getUserActualSpaceUsage()
    {
        $query = "SELECT `normalUserSpace` FROM `administration`";
        $result = $this->mysqlConnection->query($query);
        $fullSpace = mysqli_fetch_all($result);

        $command = "SELECT `storageSpace` FROM `useraccounts` WHERE `username` = '$this->username'";
        $res = $this->mysqlConnection->query($command);
        $space = mysqli_fetch_all($res);
        // alles -
        return ($fullSpace[0][0]-($fullSpace[0][0] - $space[0][0]));

    }

    public function getUserUsedSpaceInPercent($fullSpace, $usedSpace)
    {
        return ($usedSpace / $fullSpace)*100;


    }

    public function reduceUserStorageAmount() // Wenn man eine Datei hochgeladen hat soll Speicher reduziert werden
    {
        $command = "UPDATE `useraccounts` SET `storageSpace` = `storageSpace` - $this->deleteFileSize WHERE `username` = '$this->username'";
        $res = $this->mysqlConnection->query($command);
        return $res;
    }

    public function increaseUserStorageAmount() // Wenn man eine DAtei gelöscht hat soll Speicher erhöht werden
    {
        $command = "UPDATE `useraccounts` SET `storageSpace` = `storageSpace` + $this->newUploadFileSize WHERE `username` = '$this->username'";
        $res = $this->mysqlConnection->query($command);
        return $res;
    }

}
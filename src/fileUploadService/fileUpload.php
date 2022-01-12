<?php
if(isset($_POST['upload'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTMP = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $allowed = array('jpg', 'pdf', 'png', 'json', 'php');
    $allowedFileSize = 15000;
    $allowedFileSize_mb = $allowedFileSize/1000;
    $fileSize_mb = $fileSize/1000000;
    $uploadTime = date("F j, Y, g:i a");

    if(in_array($fileExt[1], $allowed)){
        if($fileError == 0){
            if($fileSize_mb <  $allowedFileSize_mb) {
                $new_file_name = uniqid('', true).".".$fileExt[1];
                $fileDestination = "uploads/$new_file_name";
                move_uploaded_file($fileTMP, $fileDestination);
                header("location: ../fileUpload.php?upload=success&fileSize=$fileSize&fileName=$fileName&fileDestination=$fileDestination&uploadTime=$uploadTime");
            }else{
                header("location: ../fileUpload.php?upload=errorsize");
              echo "zu groß die Datei es ist nur ". $allowedFileSize_mb. "MB erlaubt";
              echo "<br>"."Deine datei hat: ".$fileSize_mb."MB";
            }
        }else {
            echo "Probleme beim uploaden";
        }
    }else {
        header("location: ../fileUpload.php?upload=wrongtype");
    }
}


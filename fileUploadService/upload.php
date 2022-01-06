<?php
if(isset($_POST['submit'])){
    $file = $_FILES['file'];// FILES kriegt alles was gesubmitet wurde

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

    if(in_array($fileExt[1], $allowed)){
        if($fileError == 0){
            if($fileSize_mb <  $allowedFileSize_mb) {
                $new_file_name = uniqid('', true).".".$fileExt[1];
                $fileDestination = "uploads/$new_file_name"."_$fileName";
                move_uploaded_file($fileTMP, $fileDestination);
                header("location: index.php?upload=success");
            }else{
                header("location: index.php?upload=errorsize");
              echo "zu groß die Datei es ist nur ". $allowedFileSize_mb. "MB erlaubt";
              echo "<br>"."Deine datei hat: ".$fileSize_mb."MB";
            }
        }else {
            echo "Probleme beim uploaden";
        }

    }else {
        header("location: index.php?upload=wrongtype");
    }

}else if(isset($_GET['del'])){
   $dateiname = $_GET['del'];
   if(!unlink($dateiname)){
       header('Location: index.php?del=error');
   }else{
       header('Location: index.php?del=success');
   }



}
?>

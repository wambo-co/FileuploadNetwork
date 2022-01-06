<html>
<head>


    <title>SimpleFileUpload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body{
            display:flex;
            justify-content: center;
        }
        .upload-box{
            background-color: rgba(255,255,255,1);
            display:flex;
        }
    </style>

    übungsaufgaben
</head>

<body>
<div class="container">
    <div class="row justify-content-center align-items-center">

<?php
if(isset($_GET['upload'])){
    if($_GET['upload'] == "wrongtype"){
        echo "Diese Datei darf nicht hochgeladen werden!";
    }else if($_GET['upload'] == "success"){
        echo "Datei wurde erfolgreich hochgeladen";
    }else if($_GET['upload'] == "errorsize"){
        echo "Datei ist viel zu groß!";
    }
}else if(isset($_GET['del'])){
    $status = $_GET['del'];
    if($status == "error"){
        echo "Datei konnte nicht gelöscht werden";
    }else if($status == "success"){
        echo "Datei wurde erfolreich gelöscht";
    }
}



$verzeichnis = openDir("uploads");


while($file = readDir($verzeichnis)){

       if($file != ".." && $file != "."){
           echo "<div class='mt-2 upload-box'><a href='uploads/$file'>".$file. "</a><br><a href='upload.php?del=uploads/$file'
            class='text-danger'>(X)</a></div><br>";
       }
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data"> <!-- damit können wir auch bilder verschicken durch die
php datei -->
    <input type="file" name="file" class="form-control-file"><br>
    <button type="submit" name="submit" class="btn btn-primary mt-2">Upload</button>
</form>
</div>
</div>
</body>
</html>
<?php
$username = $_GET['username'];
$password = $_GET['password'];
$email = $_GET['email'];
$adresa = $_GET['adresa'];

if (isset($_POST["upload"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["upload"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_POST['save'])) {
    $connection = new mysqli('localhost', 'Delia', 'delia12', 'web') or die("Can't connect");
    $query = "INSERT INTO users VALUES (?,?,?,?,?,?)";
    $stmt = $connection->prepare($query);
    $initiale = $_POST['initiale'];
    $suc = $_POST['suc'];
    $stmt->bind_param('ssssss', $username, $password, $email, $adresa, $initiale, $suc);
    $stmt->execute();
    header('Location:login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register3</title>
</head>
<body>

<form method="post">
    <label>
        Initialele tatalui:
        <input type="text" name="initiale">
    </label>

    <br><br>

    <label>
        Suc preferat:
        <input type="text" name="suc">
    </label>

    <br><br>

    <input type="submit" name="prev" value="Prev">
    <input type="submit" name="save" value="Save">
</form>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="upload" name="upload">
</form>

</body>
</html>

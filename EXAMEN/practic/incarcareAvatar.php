<?php

$utilizator=$_POST['username'];

$target_dir="Resurse/";
$target_file=$target_dir.$utilizator.substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);
$extensie=substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);
//muta in directorul Resurse
if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)){
    echo "Avatarul a fost incarcat cu succes!<br/>";
}
else {
    echo "Avatarul NU a fost incarcat cu succes!";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE user SET avatar='$target_file' WHERE username='$utilizator'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

header("Location: profile.php");
<?php

$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$nume=$_POST['nume'];
$prenume=$_POST['prenume'];
$avatar=$_POST['avatar'];

$target_dir="Resurse/";
$target_file=$target_dir.$username.substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);
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

$email=mysqli_real_escape_string($conn, $email);
$nume=mysqli_real_escape_string($conn, $nume);
$prenume=mysqli_real_escape_string($conn, $prenume);
$username=mysqli_real_escape_string($conn, $username);
$password=mysqli_real_escape_string($conn, $password);

$data=date('Y-m-d H:i:s');

$sql = "INSERT into  user(nume, prenume, username,password,email,avatar,dataSiOra) values ('$nume','$prenume','$username','$password','$email','$target_file','$data'";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . $conn->error;
}

$conn->close();
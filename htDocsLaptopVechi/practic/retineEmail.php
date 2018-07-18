<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: form3.php");
    die();
}
$utilizator=$_SESSION['username'];
$email=$_POST['email'];


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


$sql = "UPDATE user SET email='$email'WHERE username='$utilizator'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
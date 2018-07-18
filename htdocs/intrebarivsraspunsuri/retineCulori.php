<?php


session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}
$utilizator=$_SESSION['utilizator'];
$scris=$_POST['scris'];
$background=$_POST['background'];
$font=$_POST['font'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pregatire2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$scris=mysqli_real_escape_string($conn, $scris);
$background=mysqli_real_escape_string($conn, $background);
$font=mysqli_real_escape_string($conn, $font);

$sql = "UPDATE users SET scris='$scris', background='$background', font='$font'  WHERE user='$utilizator'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
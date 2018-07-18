<?php
/**
 * Created by PhpStorm.
 * User: Deeathex
 * Date: 6/18/2018
 * Time: 1:21 PM
 */

session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}
$utilizator=$_SESSION['utilizator'];
$parolaVeche=$_POST['parolaVeche'];
$parolaNoua=$_POST['parolaNoua'];

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

$utilizator=mysqli_real_escape_string($conn, $utilizator);
$parolaVeche=mysqli_real_escape_string($conn, $parolaVeche);
$parolaNoua=mysqli_real_escape_string($conn, $parolaNoua);
echo $utilizator." ".$parolaVeche." ".$parolaNoua;

$sql = "UPDATE users SET password='$parolaNoua' WHERE user='$utilizator' AND password='$parolaVeche'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();


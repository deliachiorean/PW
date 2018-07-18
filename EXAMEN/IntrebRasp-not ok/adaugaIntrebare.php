<?php
session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}

//iau intrebarea din GET
$intrebare=$_GET['intrebare'];
//iau utilizatorul de pe sesiune
$utilizator=$_SESSION['utilizator'];

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

$data=date('Y-m-d H:i:s');

$sql = "INSERT INTO questions (question, data, utilizator)
VALUES ('$intrebare', '$data', '$utilizator')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


header("Location: paginaPrincipala.php"); // Redirecting To Home Page
?>
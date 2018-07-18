<?php
session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}

//iau intrebarea din GET
$idIntrebare=$_POST['id'];
$raspuns=$_POST['raspuns'];
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

$sql = "INSERT INTO answers (answer, idquestion, iduser, dataCreare)
        VALUES ('$raspuns', $idIntrebare, '$utilizator', '$data')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

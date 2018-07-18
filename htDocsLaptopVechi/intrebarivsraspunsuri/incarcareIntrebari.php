<?php
session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}

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

$sql = "SELECT * FROM questions INNER JOIN users
		ORDER BY data DESC";

$result=$conn->query($sql);

//incapsulam intrebarile intr-un JSON
$valori=array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $valori[]=array($row["question"],$row["data"],$row["user"],$row["avatar"],$row["id"]);
    }
}
$conn->close();

//tot ce scriu cu echo ajunge in javascript daca sunt in call ajax
echo json_encode($valori);
?>
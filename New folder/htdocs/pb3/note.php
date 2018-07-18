<?php

$username = "root";
$password = "";
$servername = "localhost";
$dbname="useri";

$nume=$_POST["nume"];
$pren=$_POST["prenume"];
$grup=$_POST["grupe"];
$disc=$_POST["disciplina"];
$nota=$_POST["nota"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = "Update studenti set nota= '$nota' WHERE nume='$nume' and prenume='$pren' and materie='$disc' and grupa='$grup'";
	$result = $conn->query($query);





?>
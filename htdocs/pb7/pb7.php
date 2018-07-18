<?php
	$username = "root";
	$password = "";
	$servername = "localhost";
	$dbname="pb7";

	$nume=$_POST['nume'];
	$com=$_POST['comentariu'];


	$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	$query = "Insert into articol(nume,comentariu) values ('$nume','$com')";
	echo "Comentariul dumnavoastra a fost trimis mai departe cu succes, va rugam sa asteptati confirmarea din partea administratorului<br>Multumim!";


?>
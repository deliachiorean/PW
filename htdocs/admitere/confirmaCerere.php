<?php
	$idCerere=$_GET['id'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "admitere";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 


	$sql = "UPDATE inregistrare SET  status='confirmata' WHERE id=$idCerere";

	$conn->query($sql);
	$conn->close();

?>
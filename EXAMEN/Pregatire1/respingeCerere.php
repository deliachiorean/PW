<?php
	$idCerere=$_GET['id'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pregatire1";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$dataConfirmare=date('Y-m-d H:i:s');

	$sql = "UPDATE cereri SET dataConfirmare='$dataConfirmare', status='respinsa' WHERE id=$idCerere";

	$conn->query($sql);
	$conn->close();

?>
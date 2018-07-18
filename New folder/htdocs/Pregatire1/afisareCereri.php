<?php
	$cookie_name="userCerere";
	$email="";

	if(isset($_COOKIE[$cookie_name])) {
	    $email=$_COOKIE[$cookie_name];
	}

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

	$email=mysqli_real_escape_string($conn, $email);

	$sql = "SELECT * FROM cereri
			WHERE ((dataEfectuare>NOW()-INTERVAL 2 MINUTE) AND status <> 'inAsteptare') OR status = 'inAsteptare'
			ORDER BY dataEfectuare DESC";

	$result=$conn->query($sql);

	$valori=array();
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
    		$emailCurent="";
    		$telefonCurent="";
	    	if ($row["email"]===$email) {
	    		$emailCurent=$email;
	    		$telefonCurent=$row["telefon"];
	    	}
	    	else {
	    		$emailCurent=substr($row["email"],0,4)."******";
	    		$telefonCurent=substr($row["telefon"],0,4)."******";
	    	}
	    	$valori[]=array($row["id"],$row["dataEfectuare"],$emailCurent,$telefonCurent,$row["status"]);
	    }
	}
	$conn->close();

	echo json_encode($valori);
?>

<?php
   $servername = "localhost";
$username = "Ralu";
$password = "raluca1997";
$dbname = "phplab";
 // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$usr = $_POST["email"];
	$pwd = $_POST["password"];
    $sql = "SELECT role,id FROM logintable where email = '$usr' and password = '$pwd'";
    $result = $conn->query($sql);


	$rol = "";
	$id = "";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
			$rol = "$row[rol]";
			$id = "$row[id]";
		}
    }
	session_start();
	$_SESSION['userId'] = $id;
	$_SESSION['rol'] = $rol;
	if($rol == 1){
		//professor
		Header("Location: professor.php");
	} else {
		//student
		Header("Location: student.php");
	}
    $conn->close();
?>
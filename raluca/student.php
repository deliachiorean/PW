<?php
	// get user id and rol
	session_start();
	$userId = $_SESSION['userId'];
	$rol = $_SESSION['rol'];
	//echo "E student $userId  $rol";
	
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
	
	$sql = "SELECT materii.numeMaterie as materie, note.nota as nota FROM note inner join materii on note.idMaterie = materii.idMaterie where note.idUser = $userId";

	$result = $conn->query($sql);
	echo "<div align='center'><table border='1'><tr><th>Materie</th><th>Nota</th></tr>";

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            echo "<tr><td>" . $row["materie"]. "</td><td>" . $row["nota"]. "</td>";
        }
    } else {
        echo "0 results";
    }
    
    echo "</table></div>";

    $conn->close();
?>
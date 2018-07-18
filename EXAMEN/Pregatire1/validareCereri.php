<?php
	session_start();
	if (!isset($_SESSION['utilizator'])) {
		header("Location: admin.php");
		die();
	}
	//echo "Sunteti logat cu utilizatorul ".$_SESSION['utilizator'];

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

	$sql = "SELECT * FROM cereri
			WHERE status = 'inAsteptare'";

	$result=$conn->query($sql);
	echo "<table>";
	echo "<tr>";
	echo "<th>Nr. inregistrare</th>";
	echo "<th>Nume</th>";
	echo "<th>Prenume</th>";
	echo "<th>Adresa</th>";
	echo "<th>Email</th>";
	echo "<th>Telefon</th>";
	echo "<th>Data efectuare</th>";
	echo "<th>Confirmare</th>";
	echo "<th>Respingere</th>";
	echo "</tr>";
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
    	echo "<td>".$row["id"]."</td>";
    	echo "<td>".$row["nume"]."</td>";
    	echo "<td>".$row["prenume"]."</td>";
    	echo "<td>".$row["adresa"]."</td>";
    	echo "<td>".$row["email"]."</td>";
    	echo "<td>".$row["telefon"]."</td>";
    	echo "<td>".$row["dataEfectuare"]."</td>";
    	echo "<td><button onclick='confirmaCerere(".$row["id"].")'>Confirmare</button></td>";
    	echo "<td><button onclick='respingeCerere(".$row["id"].")'>Respingere</button></td>";
    	echo "</tr>";
    }
	echo "</table>";
	$conn->close();
?>
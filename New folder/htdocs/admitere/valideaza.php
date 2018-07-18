<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header("Location: admin.php");
		die();
	}
	//echo "Sunteti logat cu utilizatorul ".$_SESSION['utilizator'];

	$servername = "localhost";
	$user= "root";
	$password = "";
	$dbname = "admitere";

	// Create connection
	$conn = new mysqli($servername, $user, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM inregistrare
			WHERE status = 'inAsteptare'";

	$result=$conn->query($sql);
	echo "<table>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Nume</th>";
	echo "<th>Medie</th>";
	echo "<th>Nota</th>";
	echo "<th>MaterieNota</th>";
	echo "<th>DataNasterii</th>";
	echo "<th>Avatar</th>";
	echo "<th>OptiuniAlese</th>";
	echo "<th>Confirmare</th>";
	echo "<th>Respingere</th>";
	echo "</tr>";
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
    	echo "<td>".$row["id"]."</td>";
    	echo "<td>".$row["nume"]."</td>";
    	echo "<td>".$row["medie"]."</td>";
    	echo "<td>".$row["nota"]."</td>";
    	echo "<td>".$row["materie"]."</td>";
    	echo "<td>".$row["datepicker"]."</td>";
    	echo "<td>".$row["avatar"]."</td>";
    	echo "<td>".$row["selected_options"]."</td>";
    	echo "<td><button onclick='confirmaCerere(".$row["id"].")'>Confirmare</button></td>";
    	echo "<td><button onclick='respingeCerere(".$row["id"].")'>Respingere</button></td>";
    	echo "</tr>";
    }
	echo "</table>";
	$conn->close();
?>
<a href="logout.php">logput</a>


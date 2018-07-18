
<html>
<head></head>
<body>
	<?php
		session_start();
		$userId = $_SESSION['userId'];
		$rol = $_SESSION['rol'];
		
		
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
		
		$sql = "SELECT id,email FROM logintable where rol == 0";

		$result = $conn->query($sql);
		$mainTable = "<div align='center'><table><tr><th>Materii</th> <th>Studenti</th></tr>";
		$tableStudenti = "<table border='1'><tr><th>id</th><th>EMAIL</th></tr>";
		//echo "<table border='1'><tr><th>Materie</th><th>Nota</th></tr>";

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$tableStudenti = $tableStudenti . "<tr><td>" . $row["id"]. "</td><td>" .$row["email"]. "</td></tr>";
			}
			$tableStudenti = $tableStudenti . "</table>";
		} else {
			echo "0 results";
		}
		
		$sql = "SELECT id,numeMaterie FROM materii";

		$result = $conn->query($sql);
		$tableMaterii = "<table border='1'><tr><th>id</th><th>Materie</th></tr>";

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$tableMaterii = $tableMaterii . "<tr><td>" . $row["id"]. "</td><td>" .$row["numeMaterie"]. "</td></tr>";
			}
			$tableMaterii = $tableMaterii . "</table>";
		} else {
			echo "0 results";
		}
		
		$mainTable = $mainTable . "<tr><td valign='top'>" .$tableStudenti . "</td><td valign='top'>" . $tableMaterii . "</td></tr></table></div>";
		$conn->close();
		echo $mainTable;
	?>
	<div align = "center">
		<form action="insert.php" method="post">
			Id Materie: <input type="text" name="idMaterie"><br>
			Id Student: <input type="text" name="idStudent"><br>
			Nota: <input type="text" name="nota"><br>
			<input type="submit">
		</form>
	</div>
</body>
</html>

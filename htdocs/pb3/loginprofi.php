<?php
	$username = "root";
	$password = "";
	$servername = "localhost";
	$dbname="useri";
	
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$myusername = $_POST['user'];
	$mypassword = $_POST['pass'];
	
	
	$query = "SELECT * FROM profesori WHERE username='$myusername' and password='$mypassword'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		//echo "Good job!";
		$select="select nume,prenume,grupa,materie from studenti";
		$select = $conn->prepare($select);
		$select->execute();
		$select->bind_result($nume,$prenume,$grupa,$materie);
		/*$rez=$conn->query($select);
		 while($row = $rez->fetch_array()) {

   foreach($row as $field) {
        echo ' <td> ' . htmlspecialchars($field) ;
    }

}}*/

echo "<h2>Lista studenti</h2>";
	echo "<br>";
while($select->fetch()){
	
	echo "<tr>";
	echo "<td>" . $nume . "</td> ";
	echo "<td>" . $prenume . "</td> ";
	echo "<td>" . $grupa . "</td> ";
	echo "<td>" . $materie . "</td> ";
	echo "<br>";



}

}
	
else{
	if($result->num_rows ==1){
		echo "Login well done";
	}else{
		echo 'Incorrect Username or Password';
	}
	}
	$conn->close();

	
	
?>


<html>
	<body>
		<h2>Asignare note studenti</h2>
			<form action="note.php" method="POST">
				<p>Nume</p><input type="text" name="nume" />
				<p>Prenume</p><input type="text" name="prenume" />
				<p>Grupa</p><input type="text" name="grupe"  />
				<p>Disciplina</p><input type="text" name="disciplina" />
				<p>Nota</p><input type="number" name="nota" min="1" max="10" />
				<br>
				<br>
				<input type="submit" value="Save" />
			</form>
	</body>
</html>
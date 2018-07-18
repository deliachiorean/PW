<?php
	$username = "root";
	$password = "";
	$servername = "localhost";
	$dbname="pb7";
	
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$myusername = $_POST['user'];
	$mypassword = $_POST['pass'];
	
	
	$query = "SELECT * FROM admin WHERE username='$myusername' and password='$mypassword'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		//echo "Good job!";
		$select="select nume,comentariu from articol";
		$select = $conn->prepare($select);
		$select->execute();
		$select->bind_result($nume,$comentariu);
		/*$rez=$conn->query($select);
		 while($row = $rez->fetch_array()) {

   foreach($row as $field) {
        echo ' <td> ' . htmlspecialchars($field) ;
    }

}}*/
echo "<h3>Pending comments</h3>";

while($select->fetch()){
	
	echo "<tr>";
	echo "<td>" . $nume . "</td> ";
	echo "<td>" . $comentariu . "</td> ";
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

	
	echo "<h2>Accept comments from</h2>";

?>


<html>
	<body>
			<form action="postcomentarii.php" method="POST">
				<p>Nume</p><input type="text" name="nume" />
				<p>Comenariu</p><input type="text" name="comentariu" />
				<br>
				<br>
				<input type="submit" value="Accept" />
			</form>
	</body>
</html>
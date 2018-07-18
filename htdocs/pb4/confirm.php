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
	
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	
	$query = "SELECT * FROM inbox WHERE user='$myusername' and pass='$mypassword'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		echo "Good job!";
}
else{
	if($result->num_rows ==1){
		echo "Login well done";
	}else{
		echo 'Incorrect Username or Password';
	}
	}
	$conn->close();



$insert="INSERT INTO user (username, password) VALUES ('$user', '$pass')";
$result = $conn->query($insert);
?>
<html>
<body>
			<form action="confirm.php" method="POST">
				<p>Username:</p><input type="text" name="userinbox" />
				<p>Password:</p><input type="password" name="passinbox" />
				<br />
				<input type="submit" value="Signup!" />
			</form>
	</body>
</html>

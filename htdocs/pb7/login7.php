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
	
	//$myusername = stripslashes($myusername);
	//$mypassword = stripslashes($mypassword);
	
	$query = "SELECT * FROM user WHERE username='$myusername' and password='$mypassword'";
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

	
	
?>
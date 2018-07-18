<?php
	$username = "root";
	$password = "";
	$servername = "localhost";
	$dbname="useri";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


		if(isset($_POST['user']) && isset($_POST['pass'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$query = "SELECT * FROM user WHERE username='$user'";
			$result = $conn->query($query);

if ($result->num_rows > 0) {
				echo "Username already exists!";
			}else{
$to = $_POST['email'];
$subject = "Confirm registration";
$txt = "<a href='confirm.php'>Confirm here</a>"."for the following user: ".$user."and password: ".$pass." ignore if you don`t want to confirm!";
$headers = "From: admin@firmadefirma.com";

mail($to,$subject,$txt,$headers);
				
			}
	}
$conn->close();
?>

<html>
	<body>
		<h1>Signup!</h1>
			<form action="new_user.php" method="POST">
				<p>Email:</p><input type="email" name="email" />
				<p>Username:</p><input type="text" name="user" />
				<p>Password:</p><input type="password" name="pass" />
				<br />
				<input type="submit" value="Signup!" />
			</form>
	</body>
</html>
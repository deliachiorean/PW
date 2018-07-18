<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
		if (empty($_POST['utilizator']) || empty($_POST['parola'])) {
			$error = "Utilizator sau parola incorecte!";
		}
		else {
			// Define $username and $password
			$username=$_POST['utilizator'];
			$password=$_POST['parola'];

			$servername = "localhost";
			$usernameBD = "root";
			$passwordBD = "";
			$dbname = "produse";

			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			$conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($conn,$username);
			$password = mysqli_real_escape_string($conn,$password);
			// SQL query to fetch information of registerd users and finds user match.
			$sql="select * from users where user='$username'";
			$result=$conn->query($sql);
			if ($result->num_rows === 1) {
				$row=$result->fetch_assoc();
				if ($row["password"]===$password){
					$_SESSION['utilizator']=$username; // Initializing Session
					header("location: paginaPrincipala.php"); // Redirecting To Other Page
				}
				else {
					$error = "Utilizator sau parola incorecte!";
				}
			}
			else {
				$error = "Utilizator sau parola incorecte!";
			}
			$conn->close();
		}

	}
?>
<?php

//include("config/config.php");
$_DB_servername = "localhost";
$_DB_name = "tranzactii.db";
$_DB_username = "root" ;
$_DB_password = "";
$_URL_SITE= "http://localhost/tranzactii";

session_start();

//daca a dat submit ... se incepe logarea
if(isset($_POST['submit'])){
	if (!isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['username']) || empty($_POST['password'])){	
		echo "You have not completed all fields."; 
		echo "<br><a href=$_URL_SITE> Back! </a>";
		return false;
	}

	//altfel daca sunt toate campurile completate:
	//1. se deschide conexiunea la DB
	$conn = new mysqli($_DB_servername, $_DB_username, $_DB_password, $_DB_name);
	if ($conn->connect_error)  
		die("Connection failed: " . $conn->connect_error); 

	//2. se iau datele din field-uri
	$username_post = mysqli_real_escape_string($conn, $_POST['username']);
	$password_post = mysqli_real_escape_string($conn, $_POST['password']);

	//3. se verifica daca se potriveste cu admin din DB si daca e ok -> se seteaza $_SESSION
	$query = "SELECT * FROM users where username= '$username_post' and password = '$password_post';"; 
	$result = $conn->query($query);


	if(is_object($result) && $result->num_rows == 1){
		$row = $result->fetch_assoc();
		$username_db = $row['username'];
		$password_db = $row['password'];
		$id_db = $row['id'];

        $result->close();
        $_SESSION["username"] = $username_post;
        $_SESSION["id"] = $id_db;
        header("HTTP/1.1 301 Moved Permanently");
    	header("Location:$_URL_SITE");
	} else {
		echo "Invalid username or password.!"; 
		echo "<br><a href=$_URL_SITE> Back! </a>";
    }
}
else{
	header("Location: $_URL_SITE");
}
// altfel se redirectioneaza spre index... pt ca a intrat din url... hack...

?>
<?php
	include('login.php');
	if(isset($_SESSION['utilizator'])){
		header("location: paginaPrincipala.php");
		die();
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Administrator</title>
	</head>
	<body>
		<form action="login.php" method="post">
			<label>Utilizator:</label>
			<input type="text" name="utili"><br>
			<label>Parola</label>
			<input type="password" name="parola"><br>
			<input type="submit" name="submit" value="Login">
			</form>
	
	</body>
	</html>
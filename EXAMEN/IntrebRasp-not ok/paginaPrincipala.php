<?php
session_start();
if(!isset($_SESSION['utilizator'])){
	header("location: admin.php");
	die();
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ValidareCereri</title>
	<link rel="stylesheet" type="text/css" href="colaps.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div id='container'>
		<b id='logout'>
			<a href="logout.php">LogOut</a></b>
			<br>
		<b idd='profile'>
			<a href="profile.php">Profile</a></b>
		<div>
			<div>
				Intrebare:<input id='inputIntrebare' type='text' name='nume'/>
			</div>
			<button onclick="adaugaIntrebare()">Adauga Intrebare</button>
			<div id='setColapsari'>
			</div>
		</div>
	</div>
</body>
<script src="adaugaIntrebare.js"></script>
</html>
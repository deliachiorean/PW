<?php
 session_start();
 if(!isset($_SESSION['utilizator'])){
 	header("location: logare.php");
 	die();
 }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
</head>
<body>
	<div id="container">
		<fieldset>
			<legend> ~ SchimbaParola ~ </legend>
			<label>Parola veche: </label>
			<input type="text" id="parolaVeche"><br>
			<label>Parola noua: </label>
			<input type="text" id="parolaNoua">
			<br>
			<button onclick="schimbaParola()">Schimba Parola</button>
		</fieldset>
		<fieldset>
			<legend> ~ Upload avatar ~ </legend>
			<form enctype="multipart/form-data" action="incarcaAvatar.php" method="post">
				<label>Upload avatar:</label>
				<input type="file" name="avatar">
				<br>
				<input type="submit" value="Incarca  avatar" >
			</form>
		</fieldset>
		<fieldset>
			<legend> ~ Alege culori ~ </legend>
			<label>culoare scris:</label>
			<input type="color" id="scris">
			<br>
			<label>culoare fundal:</label>
			<input type="color"id="background">
			<br>
			<label>culoare font:</label>
			<input type="color" id="font">
			<br>
			<button onclick="retineCulori()">Salveaza Schimbari</button>
		</fieldset>
		<b id="SprePaginaPrincipala"><a href="paginaPrincipala.php">SprePaginaPrincipala</a></b>
	</div>

</body>
<script src="profil.js"></script>
</html>
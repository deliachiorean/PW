<!DOCTYPE html>

<?php

    session_start();
	
	if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
        header("Location: index.php");
    }


?>

<html>
<head>
    <title>Admin</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
</head>
<body>

<div align="center">
	<form action="logout.php" style="float: right">
		<input type="submit" value="Logout" />
	</form>	
	<br>
	<br>
	
	<form method="post"  enctype="multipart/form-data">
        <span for="nume">Denumire</span>
        <br/>
        <input name="nume" id="nume"  type="text">
        <br/>
	
		<span for="descriere">Descriere</span>
        <br/>
        <input name="descriere" id="descriere" type="text" >

        <br/>
        <span for="producator">Producator</span>
		<br>
        <input name="producator" id="producator"  type="text">
		<br/>
		
        <span for="pret">Pret</span>
		<br>
        <input name="pret" id="pret"  type="text">
		<br/>
		
        <span for="cantitate">Cantitate</span>
		<br>
        <input name="cantitate" id="cantitate"  type="text">
		<br/>
		
        <label>Poza</label><br><input type="file" name="logo" id="logo"/>
		
        
		<br/><br/>
        <input type="submit" value="Adauga Produs" onclick="form.action='addProdus.php'">
		<br>
		<input type="submit" value="Sterge Produs" onclick="form.action='removeProdus.php'">
		
    </form>
</div>

</body>
</html>
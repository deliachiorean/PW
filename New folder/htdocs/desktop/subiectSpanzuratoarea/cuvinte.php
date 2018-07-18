<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="callAjax.js"></script>
</head>
<body>
	<?php
		session_start();
		if(!isSet($_SESSION["id"]))
		{
			header("refresh:3;url=login.html" );
			die("You can't access this page. We will redirect you to login page");				
		}
		
	?>
	<br>
	<span> Adauga un cuvant: </span>
	<input type="text" id="cuvant" name="cuvant">
	<button id="btnAdd"> Adauga un cuvant </button>
	<br>
	<div id="container"></div>
	<div id="eroare"></div>

	<a href="logout.php"> Click here to logout </a>
	
</body>
</html>



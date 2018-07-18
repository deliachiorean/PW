<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formular numarul 2</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script src="form2.js" content="text/javascript"></script>-->
    <!--<link rel="stylesheet" href="style.css">-->
    <?php
    session_start();
    ?>
</head>
<body>
	<div id="pers">
		<form action="adaugaUser.php" method="post">
	    	<input type="text" name="username" id="username" placeholder="Username" required><br>
	    	<input type="text" name="password" id="password" placeholder="Password" required><br>
	    	<input type="submit" id="submit" value="Next">
	    </form>
	    <b id="gobacktofirst"><a href="form1.php">Spre pagina anterioara</a></b>
	</div>
</body>
<script src="form3.js"></script>
</html>



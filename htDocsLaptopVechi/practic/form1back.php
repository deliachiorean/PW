<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formular 1</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
</head>
<?php
//session_start();
//session_unset();
//session_destroy();
?>
<body>
	<div id="pers">
	<form action="form1.php">
    <input type="text"  name="nume" value="<?php echo $_SESSION['nume'] ?>">
    <input type="text"  name="prenume" value="<?php echo $_SESSION['prenume'] ?>">
    <input type="submit" id="submit" value="Next">
    </form>
    </div>

</body>
</html>

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
<form action="adaugaNP.php" method="post">
    <input type="text" name="nume" id="nume" placeholder="Nume" required><br>
    <input type="text" name="prenume" id="prenume" placeholder="Prenume" required><br>
    <input type="submit" id="submit" value="Next">
</form>
</body>
<script src="form3.js"></script>
</html>
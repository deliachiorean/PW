<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
    //    header("location: admin.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Magazin</title>
    <link rel="stylesheet" type="text/css" href="colapsare.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id='container'>
    <b id="logout"><a href="logout.php">Log Out</a></b><br>
    <div>
        <div>
            Produs:
            <input id='inputIntrebare' type="text" name="nume"/>
        </div>
        <button onclick='adaugaProdus()'>Adauga produs</button>
		<button onclick='stergeProdus()'>Sterge produs</button>
        <div id="setColapsari">

        </div>
    </div>
</div>
</body>
<script src="adaugaProdus.js"></script>

<script src="stergeProdus.js"></script>
</html>
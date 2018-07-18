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
    <title>Validare Cereri</title>
    <link rel="stylesheet" type="text/css" href="colapsare.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id='container'>
    <b id="logout"><a href="logout.php">Log Out</a></b><br>
    <b id="profile"><a href="profile.php">Your profile</a></b>
    <div>
        <div>
            Intrebare:
            <input id='inputIntrebare' type="text" name="nume"/>
        </div>
        <button onclick='adaugaIntrebare()'>Adauga intrebare</button>
        <div id="setColapsari">

        </div>
    </div>
</div>
</body>
<script src="adaugaIntrebare.js"></script>
</html>
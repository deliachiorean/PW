<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formular 1</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="form1Copy.js" content="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
session_unset();
session_destroy();
?>
<body>
<form action="addRezervare.php" method="post">
    <input type="text" name="nume" id="nume" placeholder="Nume"><br>
    <input type="text" name="prenume" id="prenume" placeholder="Prenume"><br>
    <table id="tabel">
        <thead>
        <th>Id</th>
        <th>Oras plecare</th>
        <th>Oras sosire</th>
        <th>Ora plecare</th>
        <th>Ora sosire</th>
        <th>Zi din saptamana</th>
        </thead>
        <tbody id="bodyTabel"></tbody>
    </table>
    <input type="date" name="data" id="data" placeholder="Data zborului"><br>
    <input type="submit" value="Save">
</form>
</body>
</html>
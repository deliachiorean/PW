<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formular 1</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="form1.js" content="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css"/>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script>
        $(function () {
            // $("#datepicker").datepicker({minDate: new Date(2018, 5, 20)});
            $("#datepicker").datepicker({minDate: new Date()});
        });
    </script>
</head>
<?php
//session_start();
//session_unset();
//session_destroy();
?>
<body>
<form action="addRezervare.php" method="post">
    <input type="text" name="nume" id="nume" placeholder="Nume" required><br>
    <input type="text" name="prenume" id="prenume" placeholder="Prenume" required><br>
    <input type="text" name="idZbor" id="idZbor" hidden required>
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
    <input type="text" name="data" id="datepicker" placeholder="Data zborului" required><br>
    <input type="submit" value="Save">
</form>
</body>
</html>
<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location: admin.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validare Cereri</title>
</head>
<body>
    <div id="cereri">

    </div>
</body>
<script src="valid.js"></script>
</html>
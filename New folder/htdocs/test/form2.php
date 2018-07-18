<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formular numarul 2</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="form2.js" content="text/javascript"></script>
    <!--<link rel="stylesheet" href="style.css">-->
    <?php
    session_start();
    ?>
</head>
<body>
<div id="pers">
    <form action="addRezervareBD.php" method="post" id="form">
        <input type="text" readonly name="numeRez" value="<?php echo $_SESSION['nume'] ?>">
        <input type="text" readonly name="prenumeRez" value="<?php echo $_SESSION['prenume'] ?>">

        <input type="submit" value="Save">
    </form>
</div>
<input type="button" id="add" value="+">
<input type="button" id="delete" value="-">

</body>
</html>
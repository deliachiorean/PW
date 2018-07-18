<?php
    include('login.php');

    if (isset($_SESSION['utilizator'])) {
        header("location: paginaPrincipala.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form action="login.php" method="post">
        Utilizator:<input type="text" name="utilizator"><br>
        Parola:<input type="password" name="parola"><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
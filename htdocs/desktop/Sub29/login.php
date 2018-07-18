<?php
    include('validareLogin.php');
    if (isset($_SESSION['utilizator'])) {
        header("location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <div>
            Utilizator:
            <input type="text" name="utilizator">
        </div>
        <div>
            Parola:
            <input type="password" name="parola">
        </div>
        <input name="submit" type="submit" value="Login"/>
    </form>
</body>
</html>

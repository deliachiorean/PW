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
        <table>
            <tr>
                <td>Utilizator:</td>
                <td><input type="text" name="utilizator"></td>
            </tr>
            <tr>
                <td>Parola:</td>
                <td><input type="password" name="parola"></td>
            </tr>
            <tr>
                <td><input name="submit" type="submit" value="Login"/></td>
                <td></td>
            </tr>
        </table>
    </form>
    <b><a href="indexUser.php">Vezi produsele</a></b><br/>
</body>
</html>

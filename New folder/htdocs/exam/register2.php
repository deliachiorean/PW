<?php
$username = $_GET['username'];
$password = $_GET['password'];

if (isset($_POST['next'])) {
    $email = $_POST['email'];
    $adresa = $_POST['adresa'];
    $email = stripslashes($email);
    $adresa = stripslashes($adresa);

    header('Location:register3.php?username=' . $username . '&password=' . $password . '&email=' . $email . '&adresa=' . $adresa);
}

if (isset($_POST['prev'])) {
//    $username = $_POST['username'];
//    $password = $_POST['password'];
//    $username = stripslashes($username);
//    $password = stripslashes($password);

    header('Location:register1.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register2</title>
</head>
<body>

<form method="post">
    <label>
        Email:
        <input type="text" name="email">
    </label>

    <br><br>

    <label>
        Adresa:
        <input type="text" name="adresa">
    </label>

    <br><br>

    <input type="submit" name="prev" value="Prev">
    <input type="submit" name="next" value="Next">
</form>
</body>
</html>

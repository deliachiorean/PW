<?php
if (isset($_POST['next'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = stripslashes($username);
    $password = stripslashes($password);

    header('Location:register2.php?username=' . $_POST['username'] . '&password=' . $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register1</title>
</head>
<body>

<form method="post">
    <label>
        Username:
        <input type="text" name="username">
    </label>

    <br><br>

    <label>
        Password:
        <input type="text" name="password">
    </label>

    <br><br>

    <input type="submit" name="next" value="Next">
</form>
</body>
</html>

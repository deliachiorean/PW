<?php
$error = ''; // Variable To Store Error Message
if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        if (strcmp($_POST['captcha'], "6") == 0) {
            session_start(); // Starting Session
// Define $username and $password
            $username = $_POST['username'];
            $password = $_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
            $connection = mysqli_connect("localhost", "Delia", "delia12", "web");
// To protect MySQL injection for Security purpose
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
// Selecting Database

// SQL query to fetch information of registerd users and finds user match.
            $query = mysqli_query($connection, "select * from users where username='$username' AND password='$password'");
            $rows = mysqli_num_rows($query);
            if ($rows > 0) {
                $_SESSION['login_user'] = $username; // Initializing Session
                header('location: user.php?username=' . $username); // Redirecting To Other Page
            } else {
                $error = "Username or Password is invalid";
            }
            mysqli_close($connection); // Closing Connection
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
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
        <input type="password" name="password">
    </label>

    <br><br>

    <label>
        Intrebare captcha: cat face 3+3?
        <input type="text" name="captcha">
    </label>

    <input type="submit" name="login" value="Login">
</form>
</body>
</html>

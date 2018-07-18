<?php
$username = $_GET['username'];

if (isset($_POST['sterge'])) {
    $connection = new mysqli('localhost', 'Delia', 'delia12', 'web') or die("Can't connect");
    $query = "DELETE FROM users WHERE username=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $_GET['username']);
    $stmt->execute();
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>user</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jq.js"></script>
</head>
<body>

<form method="post">
    <input type="submit" name="sterge" value="Sterge Cont">
</form>

<form action="logout.php" method="post">
    <input type="submit" name="logout" value="Logout">
</form>

<input id="getUsers" type="button" value="Arata useri"/>

<table id="useri" border="1">
    <tr>
        <th>username</th>
        <th>password</th>
        <th>email</th>
        <th>adresa</th>
        <th>initiala</th>
        <th>suc</th>
    </tr>
</table>

</body>
</html>

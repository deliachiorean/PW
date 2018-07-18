<?php
/**
 * Created by PhpStorm.
 * User: Coste Claudia Ioana
 * Date: 6/14/2018
 * Time: 12:18 PM
 */
session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected to MySQL";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = test_input($_POST['username']);
    $pass = test_input($_POST['password']);
//$user="admin";
//$pass="admin";
    $sql = "select count(*) from `admin` where username=\"$user\" and password=\"$pass\"";
    $stmt = $conn->prepare($sql) or trigger_error(mysqli_error($conn), E_USER_ERROR);
    $stmt->execute() or trigger_error(mysqli_error($conn), E_USER_ERROR);
    $stmt->bind_result($v);
    while ($stmt->fetch()) {
        //echo "<b>" .$v. "</b>\n";
    }
    if ($v == 1) {
        $_SESSION['username'] = $user;
        echo 1;
        //header("Location: addCuvinteIndex.html");
    } else {
        echo 0;
        //header("Location: adminIndex.html");
    }
}
$conn->close();
?>
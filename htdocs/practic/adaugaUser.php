<?php


session_start();
require_once "connect.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $nume = test_input($_POST['username']);
    $prenume = test_input($_POST['password']);
   

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
   
    header("Location: form3.php");

}

$conn->close();


//$data=date('Y-m-d H:i:s');
<?php


session_start();
require_once "connect.php";

if (isset($_POST['nume']) && isset($_POST['prenume']) ){
    $nume = test_input($_POST['nume']);
    $prenume = test_input($_POST['prenume']);
   

    $_SESSION['nume'] = $nume;
    $_SESSION['prenume'] = $prenume;
   
   
    header("Location: form2.php");

}

$conn->close();
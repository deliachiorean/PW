<?php


session_start();
require_once "connect.php";

if (isset($_POST['nume']) && isset($_POST['prenume']) && isset($_POST['data']) && isset($_POST['idZbor'])) {
    $nume = test_input($_POST['nume']);
    $prenume = test_input($_POST['prenume']);
    $idZbor = $_POST['idZbor'];
    $data = $_POST['data'];

    $_SESSION['nume'] = $nume;
    $_SESSION['prenume'] = $prenume;
    $_SESSION['idZbor'] = $idZbor;
    $_SESSION['data'] = $data;
    header("Location: form2.php");

}

$conn->close();
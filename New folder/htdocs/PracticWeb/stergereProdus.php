<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }

    $user=$_SESSION['utilizator'];
    $id = $_GET["id"];

    $eroare = 1;

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $dbname = "practicweb";

    // Create connection
    $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM produse WHERE id=$id";

    if ($conn->query($sql) !== TRUE) {
        $eroare = 0;
    }

    $conn->close();

    if ($eroare === 1)
        echo "Produsul a fost sters cu succes!";
    else
        echo "Produsul nu a putut fi sters!";
?>
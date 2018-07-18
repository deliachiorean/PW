<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }

    $eroare = 1;

    $culoareScris = $_POST["culoareScris"];
    $culoareFundal = $_POST["culoareFundal"];
    $font = $_POST["font"];

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $dbname = "pregatire2";

    // Create connection
    $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $utilizator = $_SESSION['utilizator'];

    $sql = "UPDATE users 
            SET culoareScris = '$culoareScris',
                culoareFundal = '$culoareFundal',
                font = '$font' 
            WHERE utilizator = '$utilizator'";

    if ($conn->query($sql) !== TRUE) {
        $eroare = 0;
    }

    $conn->close();

    echo $eroare;
?>
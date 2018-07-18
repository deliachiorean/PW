<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }

    $user=$_SESSION['utilizator'];
    $idIntrebare = $_POST["id"];
    $raspuns = $_POST["raspuns"];

    $eroare = 1;

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
    $dataCreare = date('Y-m-d H:i:s');

    $sql = "INSERT INTO raspunsuri(continut, utilizator, idIntrebare, dataCreare) VALUES ('$raspuns', '$user', '$idIntrebare', '$dataCreare')";

    if ($conn->query($sql) !== TRUE) {
        $eroare = 0;
    }

    $conn->close();

    echo $eroare;
?>
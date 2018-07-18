<?php
    $textDorit = $_POST["text"];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "practicweb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $textDorit = stripslashes($textDorit);
    $textDorit = mysqli_real_escape_string($conn, $textDorit);

    $sql = "SELECT * FROM produse";

    $result = $conn->query($sql);

    $valori = array();
    while($row = $result->fetch_assoc()) {
        if (($textDorit === "") || (strpos($row["nume"], $textDorit) !== false) || (strpos($row["descriere"], $textDorit) !== false))
            $valori[] = array($row["id"], $row["nume"], $row["descriere"], $row["producator"], $row["pret"], $row["cantitate"], $row["poza"]);
    }

    $conn->close();

    echo json_encode($valori);
?>
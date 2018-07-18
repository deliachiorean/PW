<?php
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
    $dataCurenta = date('Y-m-d H:i:s');
    $id = stripslashes($id);
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "INSERT INTO clickuri(idprodus, dataclick) VALUES ($id, '$dataCurenta')";

    if ($conn->query($sql) !== TRUE) {
        $eroare = 0;
    }
    $conn->close();
    echo $eroare;
?>
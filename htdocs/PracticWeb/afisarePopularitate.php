<?php
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

    $id = $_GET["id"];
    $id = stripslashes($id);
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT dataclick
            FROM clickuri 
            WHERE idprodus = $id
            ORDER BY dataclick";

    $result = $conn->query($sql);

    $valori = array();
    while($row = $result->fetch_assoc()) {
        $valori[] = $row["dataclick"];
    }

    $conn->close();

    echo json_encode($valori);
?>
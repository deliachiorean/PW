<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }
    $user=$_SESSION['utilizator'];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "pregatire2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT I.id AS 'id', U.utilizator AS 'utilizator', U.numePoza AS 'numePoza', 
                   I.continut AS 'continut', I.dataCreare AS 'dataCreare' 
            FROM intrebari I INNER JOIN users U ON I.utilizator = U.utilizator
            ORDER BY I.dataCreare DESC";

    $result = $conn->query($sql);

    $valori = array();
    while($row = $result->fetch_assoc()) {
        $valori[] = array($row["id"], $row["utilizator"], "avatar//" . $row["numePoza"], $row["continut"], $row["dataCreare"]);
    }

    $conn->close();

    echo json_encode($valori);
?>
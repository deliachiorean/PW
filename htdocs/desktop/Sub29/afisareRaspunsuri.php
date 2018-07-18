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

    $idIntrebare = $_GET["id"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT U.utilizator AS 'utilizator', U.numePoza AS 'numePoza', 
                       R.continut AS 'continut', R.dataCreare AS 'dataCreare' 
            FROM intrebari I INNER JOIN raspunsuri R ON R.idIntrebare = I.id
                             INNER JOIN users U ON I.utilizator = U.utilizator
            WHERE I.id = $idIntrebare
            ORDER BY R.dataCreare";

    $result = $conn->query($sql);

    $valori = array();
    while($row = $result->fetch_assoc()) {
        $valori[] = array($row["utilizator"], "avatar//" . $row["numePoza"], $row["continut"], $row["dataCreare"]);
    }

    $conn->close();

    echo json_encode($valori);
?>
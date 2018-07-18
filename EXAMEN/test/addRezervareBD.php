<?php


session_start();
require_once "connect.php";
if (isset($_SESSION['nume'])) {
    $nume = $_SESSION['nume'];
    $prenume = $_SESSION['prenume'];
    $idZbor = $_SESSION['idZbor'];
    $data = $_SESSION['data'];
//    echo $nume.$prenume.$idZbor.$data;

    $randNr = rand(0, 50000);
    $nr = $randNr;
    $main = 1;
    if (verificareNrUnic($nr, $conn)) {


        $sql = "INSERT INTO `rezervari`(`nume`, `prenume`, `idZbor`, `dataAdaugarii`, `main`, `codRez`)
 VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisii", $nume, $prenume, $idZbor, $data, $main, $nr);
        $stmt->execute();
        $stmt->close();

        if (isset($_POST['nume']) && isset($_POST['prenume'])) {
            $arrayNume = $_POST['nume'];
            $arrayPrenume = $_POST['prenume'];

            for ($x = 0; $x < count($arrayNume); $x++) {
                $nume = $arrayNume[$x];
                $prenume = $arrayPrenume[$x];
                $main = 0;
                $sql = "INSERT INTO `rezervari`(`nume`, `prenume`, `idZbor`, `dataAdaugarii`, `main`, `codRez`)
 VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssisii", $nume, $prenume, $idZbor, $data, $main, $nr);
                $stmt->execute();
                $stmt->close();
            }
        }
        echo $nr;
    }
}

function verificareNrUnic($nr, $conn)
{
    $sql = "SELECT distinct codRez FROM `rezervari`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    for ($x = 0; $x < count($outp); $x++) {
        foreach ($outp[$x] as $obj => $valObj) {
            if ($valObj === $nr) return false;
        }

    }
    return true;
}


$conn->close();
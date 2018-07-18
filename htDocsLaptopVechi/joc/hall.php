<?php
/**
 * Created by PhpStorm.
 * User: Coste Claudia Ioana
 * Date: 6/17/2018
 * Time: 12:09 AM
 */


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start();
if (isset($_SESSION['nivel']) && isset($_SESSION["deGhicit"])) {
    $nivel = $_SESSION['nivel'];
    $deGhicit = $_SESSION['deGhicit'];
    if ($nivel === 3 && $deGhicit === 0) {
        //facem adagarea in BD!!!
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "p1";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("connection failed : " . $conn->connect_error);
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $sql = "SELECT * FROM `hall` ORDER by timp ASC limit 3";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            $obj=(object)array();
            $outp=array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            $obj->timp=$outp;
            $stmt->close();

            $sql = "SELECT * FROM `hall` ORDER by incercari ASC limit 3";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            $outp=array();
            $outp = $result->fetch_all(MYSQLI_ASSOC);
            $obj->incercari=$outp;
            $stmt->close();
            printf(json_encode($obj));
        }
        $conn->close();
        session_unset();
        session_destroy();
    }
}

?>
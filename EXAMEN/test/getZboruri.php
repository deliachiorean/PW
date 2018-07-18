<?php


session_start();
require_once "connect.php";
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "select * from zboruri";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($outp);
}
$conn->close();

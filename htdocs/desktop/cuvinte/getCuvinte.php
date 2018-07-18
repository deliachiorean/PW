<?php
/**
 * Created by PhpStorm.
 * User: Coste Claudia Ioana
 * Date: 6/16/2018
 * Time: 1:17 PM
 */
session_start();
if (isset($_SESSION['username'])) {
    $user=$_SESSION['username'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "p1";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Connected to MySQL";
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sql="select * from cuvinte where username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result=$stmt->get_result();
        $outp=array();
        $outp = $result->fetch_all(MYSQLI_ASSOC);
        printf(json_encode($outp));
        $stmt->close();
        $conn->close();
    }
}
else{

}

?>
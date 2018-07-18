<?php
/**
 * Created by PhpStorm.
 * User: Coste Claudia Ioana
 * Date: 6/16/2018
 * Time: 11:51 PM
 */

function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

session_start();
if (isset($_SESSION['nivel']) && isset($_SESSION["deGhicit"])){
    $nivel=$_SESSION['nivel'];
    $deGhicit=$_SESSION['deGhicit'];
    if ($nivel===3 && $deGhicit===0){
        //facem adagarea in BD!!!
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="p1";
        $conn=new mysqli($servername,$username,$password,$dbname);
        if ($conn->connect_error){
            die("connection failed : ".$conn->connect_error);
        }
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            if (isset($_GET["nume"])){
                $nume=test_input($_GET["nume"]);
                $sql="insert into hall (nume, timp,incercari) values (?,?,?)";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("sii",$nume,$_SESSION["timp"],$_SESSION["nrIncercari"]);
                $stmt->execute();
                $stmt->close();
            }
        }
        $conn->close();
    }
}
?>
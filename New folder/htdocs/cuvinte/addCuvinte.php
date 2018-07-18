<?php


function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

session_start();
if (isset($_SESSION['username'])){
    $user=$_SESSION['username'];
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="p1";
    $conn=new mysqli($servername,$username,$password,$dbname);
    if ($conn->connect_error){
        die("connection failed : ".$conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if (isset($_GET["cuvant"])){
            $cuv=test_input($_GET["cuvant"]);
            $sql="insert into cuvinte (cuvant, username) values (?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("ss",$cuv,$user);
            $stmt->execute();
            $stmt->close();
        }
    }
    $conn->close();
}
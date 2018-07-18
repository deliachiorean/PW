<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
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
        die("Connection failed: ".$conn->connect_error);
    }
    else{
        //connected to mysql
    }
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        if (isset($_GET['id'])){
            $idCuv=test_input($_GET['id']);
            $sql="delete from cuvinte where id=? and username=?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("is",$idCuv,$user);
            $stmt->execute();
            $stmt->close();
        }
    }
    $conn->close();
}

?>
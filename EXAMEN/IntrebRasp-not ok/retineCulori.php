<?php
session_start();
if(!isset($_SESSION['utilizator'])){
	header("location: logare.php");
	die();
}

$utilizator=$_SESSION['utilizator'];
$scris=$_POST['scris'];
$background=$_POST['background'];
$font=$_POST['font'];


$servername="localhost";
$user="root";
$pass="";
$db="pregatire2";

$conn=new mysqli($servername,$user,$pass,$db);

if($conn->connect_error){
	die("Conection failed:".$conn->connect_error);
}

$scris=mysqli_real_escape_string($conn,$scris);
$background=mysqli_real_escape_string($conn,$background);
$font=mysqli_real_escape_string($conn,$font);

$ql="UPDATE users 
	SET scris='$scris',background='$background', font='$font' 
	WHERE user='$utilizator'";

if($conn->qery($sql)===TRUE){
	echo "Record updated!";
}else{ 
	echo "Error updation record: ".$conn->error;
}

$conn->close();
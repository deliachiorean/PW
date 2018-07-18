<?php
session_start();
if(!isset($_SESSION['utilizator'])){
	header("location: logare.php");
	die();
}

$utilizator=$_SESSION['utilizator'];
$parolaVeche=$_POST['parolaVeche'];
$parolaNoua=$_POST['parolaNoua'];

$servername="localhost";
$user="root";
$pass="";
$db="pregatire2";

$conn=new mysqli($servername,$user,$pass,$db);

if($conn->connect_error){
	die("Conection failed:".$conn->connect_error);
}

$utilizator=mysqli_real_escape_string($conn,$utilizator);
$parolaVeche=mysqli_real_escape_string($conn,$parolaVeche);
$parolaNoua=mysqli_real_escape_string($conn,$parolaNoua);

echo $utilizator." ".$parolaVeche." ".$parolaNoua;

$sql="UPDATE users 
	  SET password='$parolaNoua'
	  WHERE user='$utilizator' AND password='$parolaVeche'";

if($conn->query($sql)===TRUE){
	echo "record updated";
}else{
	echo " Error updating record: " .$conn->error;
}
$conn->close();
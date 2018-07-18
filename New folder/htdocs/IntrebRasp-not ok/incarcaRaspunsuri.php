<?php
session_start();
if(!isset($_SESSIOn['utilizator]'])){
	header("location: logare.php");
	die();
}

$idIntrebare=$_POST['id'];
$raspuns=$_POST['raspuns'];

$utilizator=$_SESSION['utilizator'];

$server="localhost";
$user="root";
$password="";
$db="pregatire2";

$conn= new mysqli($server,$user,$password,$db);
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}

$data=date('Y-m-d H:i:s');
$sql="INSERT INTO answers(answer,idquestion,iduser,dataCreare)
		VALUES ('$raspuns',$idIntrebare,'$utilizator','$data')";

if($conn->query($sql)===TRUE){
	echo "New record created succesfully";

}else{
	echo "Error:".$sql."<br>".$conn->error;
}
$conn->close();
?>
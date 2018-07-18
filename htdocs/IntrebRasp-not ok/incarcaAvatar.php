<?php
session_start();
if(!isset($_SESSION['utilizator'])){
	header("location: logare.php");
	die();

}

$utilizator=$_SESSION['utiliztor'];
$target_dir="Resurse/";
$target_file=$target_dir.$utilizator.substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);
$extensie=substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);

if(move_uploaded_file($_FILES["avatar"]["temp_name"], $target_file)){
	echo "Avatarul a fost incarcat cu succes!!<br/>"
}
else{
	echo "Avatarul nu s-a incarcat!";
}

$server="localhost";
$user="root";
$password="";
$db="pregatire2";

$conn= new mysqli($server,$user,$password,$db);
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}
$sql="UPDATE users 
	  SET avatar='$target_file'
	  WHERE user='$utilizator'";
if($conn->query($sql)===TRUE){
	echo "Record updated succesfully!";
}
else{
	echo "Error updating record: ".$conn->error;
}

$conn->close();

header("Location: profile.php");
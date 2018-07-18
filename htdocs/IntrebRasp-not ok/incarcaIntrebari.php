<?php
session_start();
if(!isset($_SESSION['utilizator'])){
	header("location: logare.php");
	die();
}

$server="localhost";
$user="root";
$password="";
$db="pregatire2";

$conn= new mysqli($server,$user,$password,$db);
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}
$sql="SELECT * FROM questions INNER JOIN users ORDER BY data desc";

$rez=$conn->query($sql);

$values=array();
if($rez->num_rows > 0){
	while($row = $rez->fetch_assoc()){
		$values[]= array($row["question"],$row["data"],$row["user"],$row["avatar"],$row["id"]);
	}
}

$conn->close();

echo json_encode($values);

?>
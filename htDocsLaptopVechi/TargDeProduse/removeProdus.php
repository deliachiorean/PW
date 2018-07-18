<?php


$con = new mysqli('localhost','root','','produse');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));

$sql="DELETE FROM produs WHERE nume=? AND descriere=? AND producator=? AND pret=? AND cantitate=?";

$stmt = $con->prepare($sql);



$stmt->bind_param('sssss',strval($_POST['nume']),strval($_POST['descriere']),strval($_POST['producator']),$_POST['pret'],$_POST['cantitate']);

$stmt->execute();
$stmt->store_result();

header('Location: adminMain.php');

if($stmt->num_rows > 0)
{
	$message = "Produs sters cu succes";
	echo "<script type='text/javascript'>alert('$message');</script>";
}

$stmt->close();
$con->close();
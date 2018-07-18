<?php


$con = new mysqli('localhost','root','','piese');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));

$sql="DELETE FROM piesa WHERE artist=? AND titlu=? AND piesa=?";

$stmt = $con->prepare($sql);



$stmt->bind_param('sss',strval($_POST['artist']),strval($_POST['titlu']),strval($_POST['piesa']));

$stmt->execute();
$stmt->store_result();

header('Location: melodii.php');

if($stmt->num_rows > 0)
{
	$message = "Piesa stersa cu succes";
	echo "<script type='text/javascript'>alert('$message');</script>";
	   header("location:melodii.php");
}

$stmt->close();
$con->close();
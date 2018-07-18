<?php


$con = new mysqli('localhost','root','','produs');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));

$sql="INSERT INTO produs (nume,descriere,producator,pret,cantitate,poza) VALUES (?,?,?,?,?,?)";

$stmt = $con->prepare($sql);
var_dump($stmt);
if (!$stmt)
{
	echo "Eroare la query";
}


if($_FILES['logo']['name'])
{
  $save_path="C:\\xampp\\htdocs\\TargDeProduse\\poze\\".basename($_FILES['logo']['name']); // Folder where you wanna move the file.
  $myname = strtolower($_FILES['logo']['tmp_name']); //You are renaming the file here
  move_uploaded_file($_FILES['logo']['tmp_name'], $save_path); // Move the uploaded file to the desired folder
}

$stmt->bind_param('ssssss',strval($_POST['nume']),strval($_POST['descriere']),strval($_POST['producator']),$_POST['pret'],$_POST['cantitate'],strval($save_path));

$stmt->execute();
$stmt->store_result();

header('Location: adminMain.php');

if($stmt->num_rows > 0)
{
	$message = " Produs adaugat cu succes";
	echo "<script type='text/javascript'>alert('$message');</script>";
}

$stmt->close();
$con->close();
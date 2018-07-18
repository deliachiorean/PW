<?php
$name=$_POST["nume"];
	$medie=$_POST["medie"];
	$nota=$_POST["nota"];
	$materie=$_POST["materie"];
	$datepicker=$_POST["datepicker"];
	$selected_items=$_POST["selected_items"];
	$status="inAsteptare";
	
	$target_dir="Resurse/";
$target_file=$target_dir.$name.substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);
$extensie=substr(basename($_FILES["avatar"]["name"]),strlen(basename($_FILES["avatar"]["name"]))-4,4);
//muta in directorul Resurse
if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)){
    echo "Avatarul a fost incarcat cu succes!<br/>";
}
else {
    echo "Avatarul NU a fost incarcat cu succes!";
}
	

$servername="localhost";
$dbname="admitere";
$username="root";
$password="";

$conn=new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die ("Connection failed ".$conn->connect_error);
}
$name=mysqli_real_escape_string($conn, $name);
	$medie=mysqli_real_escape_string($conn, $medie);
	$nota=mysqli_real_escape_string($conn, $nota);
	$materie=mysqli_real_escape_string($conn, $materie);
	$datepicker=mysqli_real_escape_string($conn, $datepicker);
	$selected_items=mysqli_real_escape_string($conn, $selected_items);
	$status=mysqli_real_escape_string($conn,$status);

// if($_SERVER['REQUEST_METHOD']=='POST')
// 	if(isset($_POST["nume"]))
// {
// {	
	
	//$target_file=mysqli_real_escape_string($conn, $target_file);
	// if(preg_match("!image!",$_FILES['avatar']['type']))
	// {
	// 	if (copy($_FILES['avatar']['tmp_name'],$avatar_path))
	// 	{
			
			$sql = "INSERT INTO inregistrare(nume, medie, nota, materie, datepicker,avatar, selected_options, status)
			VALUES('$name','$medie','$nota','$materie','$datepicker','$target_file','$selected_items','$status')";
			if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
	// }else{
		
	// 	$_SESSION['message']="Please upload only JPG, PNG or GIF image!";
	// }

// }
// }
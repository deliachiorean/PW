<?php
	$nume=$_POST["nume"];
	$medie=$_POST["medie"];
	$nota=$_POST["nota"];
	$materie=$_POST["materie"];
	$datepicker=$_POST["datepicker"];
	$selected_items=$_POST["selected_items"];
	$status='inAsteptare'

$avatar_path = 'image/'.$_FILES['avatar']['name'];
	$avatar_path = mysqli_real_escape_string($connect,$avatar_path);
	if(preg_match("!image!",$_FILES['avatar']['type']))
	{
		if (copy($_FILES['avatar']['tmp_name'],$avatar_path))
		{
			$_SESSION['avatar'] = $avatar_path;
			$sql_1 = "INSERT INTO tbl_login(first_name, last_name, gender, email, password, address, mobile_no,poza)VALUES('$first_name','$last_name','$gender','$email','$password_hash','$address','$mobile_no','$avatar_path')";
			if (mysqli_query($connect,$sql_1))
			{
				$_SESSION['message']="Registration succesful!";
			}else{
				$_SESSION['message']="User couldn't be added!";
			}
		}
	}else{
		
		$_SESSION['message']="Please upload only JPG, PNG or GIF image!";
	}

}
}
$servername="localhost";
$dbname="admitere";
$username="root";
$password="";

$conn=new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error){
    die ("Connection failed ".$conn->connect_error);
}


	$nume=mysqli_real_escape_string($conn, $nume);
	$medie=mysqli_real_escape_string($conn, $medie);
	$nota=mysqli_real_escape_string($conn, $nota);
	$materie=mysqli_real_escape_string($conn, $materie);
	$datepicker=mysqli_real_escape_string($conn, $datepicker);
	$selected_items=mysqli_real_escape_string($conn, $selected_items);
	$target_file=mysqli_real_escape_string($conn, $target_file);

	$sql = "INSERT INTO inregistrare (nume, medie, nota, materie, datepicker,  avatar,selected_items, status)
	VALUES('$nume','$medie','$nota','$materie','$datepicker','$target_file','$selected_items','$status')";
	

	/*
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	*/

	
	$conn->close();


?>
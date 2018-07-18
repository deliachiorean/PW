<?php 

session_start();
include 'db.php';
$_SESSION['message'] = '';
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$avatar_path = 'image/'.$_FILES['avatar']['name'];
	$avatar_path = mysqli_real_escape_string($conn,$avatar_path);
	$descriere = $_POST['descriere'];
	if(preg_match("!image!",$_FILES['avatar']['type']))
	{
		if (copy($_FILES['avatar']['tmp_name'],$avatar_path))
		{
			$_SESSION['avatar'] = $avatar_path;
			$sql = "INSERT INTO images(fisier_imagine,descriere)VALUES('$avatar_path','$descriere')";
			if (mysqli_query($conn,$sql))
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

?>


<div class="main" align="center">
		<header>
		<link rel="stylesheet" type="text/css" href="styleElephant.css"/>
			<h1>Upload image and description!</h1>
			<div class="success"></div>
		</header>
		<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="file" name="avatar" class="inp"> 
				<br>
				<input type="text" name="descriere" class="inp"> 
				<br>
				<input type="submit" name="submit" value="GO" class="sub-btn">
			</form>
	</div>
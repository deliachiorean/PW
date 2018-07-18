<?php
	session_start();
	$err='';
	if(isset($_POST['submit'])){
		if(empty($_POST['utilizator']) || empty($_POST['parola'])){
			$err="utilizator sau parola	inclorecte!";
		}
		else{
			$username=$_POST['utilizator'];
			$password=$_POST['parola'];

			$servername="localhost";
			$user="root";
			$pass="";
			$db="pregatire2";

			$conn=new mysqli($servername,$user,$pass,$db);

			if($conn->connect_error){
				die("Conection failed:".$conn->connect_error);
			}
			$username=stripslashes($username);
			$password=stripslashes($password);

			$username=mysqli_real_escape_string($conn,$username);
			$password=mysqli_real_escape_string($conn,$password);


			$sql="select* from users where user '$username'";
			$rez=$conn->query($sql);
			if($rez->num_rows===1){
				$row=$rez->fetch_assoc();
				if($row["password"]===$password){
					$_SESSION['utilizator']=$username;

					header("location: paginaPrincipala.php");
				}
				else{
					$err="utilizator sau parola incorecte!";
				}
				
			}
			else{
				$err="utilizator sau parola	incorecte";
			}
			$conn->close();


		}
	}
	?>
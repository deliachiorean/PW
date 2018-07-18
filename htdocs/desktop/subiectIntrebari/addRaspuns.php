<?php
	session_start();

	if(isSet($_SESSION["data"]))
	{
		$data=$_SESSION["data"];
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($now-$data>7)
		{
			header('HTTP/1.0 400 Bad error');
		}
	}

	$intrebare1=$_POST["intrebare1"];
	$intrebare2=$_POST["intrebare2"];
	$intrebare3=$_POST["intrebare3"];
	$raspuns1=$_POST["raspuns1"];
	$raspuns2=$_POST["raspuns2"];
	$raspuns3=$_POST["raspuns3"];

	if(!empty($_POST["nume"]) && !empty($_POST["email"]))
	{
		$nume=$_POST["nume"];
		$email=$_POST["email"];
		$_SESSION["nume"]=$nume;
		$_SESSION["email"]=$email;
	}
	else 
	{
		if(!isset($_SESSION["nume"])|| !isset($_SESSION["email"]))
		{
			header('HTTP/1.0 400 Bad error');
		}
	}

	$punctaj=0;
	if(isset($_SESSION["punctaj"]))
		$punctaj=$_SESSION["punctaj"];

	$rc1=getRaspunsCorect($intrebare1);
	$rc2=getRaspunsCorect($intrebare2);
	$rc3=getRaspunsCorect($intrebare3);
	if($rc1==$raspuns1)
	{ 
		$punctaj=$punctaj+1;
	}
	

	if($rc2==$raspuns2)
	{
		$punctaj=$punctaj+1;
	}
	
	if($rc3==$raspuns3)
	{
		$punctaj=$punctaj+1;
	}
	
	$_SESSION["punctaj"]=$punctaj;



	function getRaspunsCorect($idIntrebare)
	{

		$connection=mysqli_connect("127.0.0.1","root","","subiect32015");	
		if($connection->connect_error)
			die("Connection failed: " .$connection->connect_error);

		$sqlCommand="select rc from intrebari where id=?";	
		$statement=$connection->prepare($sqlCommand);
		$statement->bind_param("i",$idIntrebare);
		$statement->execute();
		$statement->bind_result($rc);
		$statement->store_result();

		$raspunsCorect=-1;
		if($statement->fetch())
		{
			$raspunsCorect=$rc; 	
		}

		$statement->close();
		$connection->close();
		return $raspunsCorect;	
	}


?>
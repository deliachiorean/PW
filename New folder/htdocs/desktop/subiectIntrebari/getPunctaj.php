<?php
	session_start();
	
	$connection=mysqli_connect("127.0.0.1","root","","subiect32015");	
	if($connection->connect_error)
		die("Connection failed: " .$connection->connect_error);

	$sqlCommand="select count(*) as nr from intrebari";	
	$statement=$connection->prepare($sqlCommand);
	$statement->execute();
	$statement->bind_result($nr);
	$statement->store_result();

	$detalii=array();

	if($statement->fetch())
	{
		$detalii[]=array('nr'=>$nr,'punctaj'=>$_SESSION["punctaj"]);   	
	}
	$statement->close();
	
	//hall of fame
	if(isSet($_SESSION["dataStart"]))
	{
		$dataStart=$_SESSION["dataStart"];
		
		$datetime1 = date_create();
    	$datetime2 = date_create($dataStart);
		$interval = date_diff($datetime2, $datetime1);
    	$min=$interval->format('%i');
    	$sec= $interval->format('%s');
    	$total=$sec+60*$min;	
		$raport=$_SESSION["punctaj"]/$total;
	}

	$sqlCommand2="select count(*) as nrTop from top";	
	$statement2=$connection->prepare($sqlCommand2);
	$statement2->execute();
	$statement2->bind_result($nrTop);
	$statement2->store_result();
	if($statement2->fetch())
	{
		if($nrTop<3)
		{
			insertUser($_SESSION["nume"],$_SESSION["email"],$raport,$connection);
		}
		else 
		{
			replaceUser($_SESSION["nume"],$_SESSION["email"],$raport,$connection);
		}
		
	}

	
	
	$statement2->close();
	$connection->close();
	unset($_SESSION['punctaj']);
	unset($_SESSION['nume']);
	unset($_SESSION['email']);
	echo json_encode($detalii);

	function insertUser($nume,$email,$raport,$connection)
	{
		$sqlCommand="insert into top(nume,email,raport) values (?,?,?)";	
		$statement=$connection->prepare($sqlCommand);
		$statement->bind_param("ssd",$nume,$email,$raport);
		$statement->execute();	
		$statement->close();
	}

	function replaceUser($nume,$email,$raport,$connection)
	{
		$sqlCommand="select id,raport from top order by raport limit 1";	
		$statement=$connection->prepare($sqlCommand);
		$statement->execute();
		$statement->bind_result($id,$rap);
		$statement->store_result();
		if($statement->fetch())
		{
			if($rap<$raport)
			{
				$sqlCommand2="update top set nume=?, email=?, raport=? where id=?";	
				$statement2=$connection->prepare($sqlCommand2);
				$statement2->bind_param("ssdi",$nume,$email,$raport,$id);
				$statement2->execute();
				$statement2->close();
			}
		}
		$statement->close();
	}

	


?>
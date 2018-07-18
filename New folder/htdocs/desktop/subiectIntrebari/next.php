<?php
	function transform_input($data)
	{
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

	function validate_input($data)
	{
		if(empty($data) || !is_numeric($data))
			return false;
		return true;
	}		

	$start=transform_input($_GET["start"]);

	$nr=$start;
	// if(!validate_input($start) || !validate_input($step))
	// 	die ("Nu exista aceasta pagina");

	$connection=mysqli_connect("127.0.0.1","root","","subiect32015");	
	if($connection->connect_error)
		die("Connection failed: " .$connection->connect_error);

	$sqlCommand="select * from intrebari limit 3 offset ".$start;	
	$statement=$connection->prepare($sqlCommand);
	$statement->execute();
	$statement->bind_result($id, $intrebare,$r1,$r2,$r3,$rc);
	$statement->store_result();

	$detalii=array();
	while($statement->fetch())
	{
		$detalii[]=array('id'=>$id,'intrebare'=>$intrebare,'r1'=>$r1,'r2'=>$r2,'r3'=>$r3,'rc'=>$rc);   	
	}

	$statement->close();
	$connection->close();
	session_start();
	$data=(new DateTime())->format('Y-m-d H:i:s');
	if($start==0)
	{
		$_SESSION["dataStart"]=$data;	
	}
	$_SESSION["data"]=$data;
	shuffle($detalii);
	echo json_encode($detalii);

?>
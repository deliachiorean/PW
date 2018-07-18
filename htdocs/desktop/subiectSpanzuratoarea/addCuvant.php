<?php

	function get_connection()
	{
		$servername = "localhost";
	    $username = "root";
	    $password = "";
	    $dbname = "subiectspanzuratoarea";
	    $connection=mysqli_connect($servername,$username,$password,$dbname);	
		if($connection->connect_error)
			die("Connection failed: " .$connection->connect_error);
		return $connection;
	}

	$connection=get_connection();
	session_start();
	$id=$_SESSION['id'];
	if(!isset($id))
	{
		die("Nu ai acces la aceasta pagina");
	}
	else
	{
		$text=$_POST["cuvant"];

		$insertCommand="insert into cuvinte(cuvant) values(?)";	
		$statement=$connection->prepare($insertCommand);
		$statement->bind_param("s",$text);
		$statement->execute();

		if($statement)
		{
		    echo json_encode($text);	    	
	    }
	  
	  	$statement->close();
	    $connection->close();
	}

?>
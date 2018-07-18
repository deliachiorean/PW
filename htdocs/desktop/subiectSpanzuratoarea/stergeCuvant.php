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
		$idCuvant=$_POST["idCuvant"];

		$deleteCommand="delete from cuvinte where id=?";	
		$statement=$connection->prepare($deleteCommand);
		$statement->bind_param("i",$idCuvant);
		$statement->execute();

		if($statement)
		{
		    die($deleteCommand);    	
	    }
	  
	  	$statement->close();
	    $connection->close();
	}

?>
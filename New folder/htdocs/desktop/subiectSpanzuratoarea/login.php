<?php
	function get_connection()
	{
		$servername = "localhost";
	    $username = "root";
	    $password = "";
	    $dbname = "examen";
	    $connection=mysqli_connect($servername,$username,$password,$dbname);	
		if($connection->connect_error)
			die("Connection failed: " .$connection->connect_error);
		return $connection;
	}


	function transform_input($data)
	{
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

	if(isSet($_POST["submit"]))
	{
		$username = transform_input($_POST["username"]);
		$password =transform_input($_POST['password']);
		if(empty($username) || empty($password))
			die("Please enter username and password...");

		$connection=get_connection();
		$sqlCommand="select id, password from users where username=?";	
		$statement=$connection->prepare($sqlCommand);
		$statement->bind_param("s",$username);
		$statement->execute();
		$statement->bind_result($id, $realPassword);
		$statement->store_result();

		if($statement->fetch())
		{
	    	if($realPassword==$password)
	    	{
	    		echo("You are now logged in!");
	    		session_start();
				$_SESSION["id"]=$id;
				header('Location: cuvinte.php'); //TODO: change redirect file
	    	}
	    	else
	    	{
	    		echo("Unauthorized");
	    	}
	    }
	    else
	    {
	    	echo("User not found");
	    }
	    $connection->close();
	}

?>

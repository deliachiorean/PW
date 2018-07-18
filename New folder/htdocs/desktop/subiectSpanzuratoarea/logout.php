<?php
	session_start();
	if(isSet($_SESSION["id"]))
	{	
		unset($_SESSION['id']);
		session_destroy();
	    header( "location:login.html" );				
	}
	else die("You are not logged in");

?>
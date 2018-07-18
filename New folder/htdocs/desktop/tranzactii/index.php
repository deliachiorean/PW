<?php
session_name();
session_start();
//include("config/config.php");
$_DB_servername = "localhost";
$_DB_name = "examen1";
$_DB_username = "root" ;
$_DB_password = "";
$_URL_SITE= "http://localhost/tranzactii";

if(isset($_SESSION['username']) ){
	//redirect the admin to add new project page
	//echo "Seted: ". $_SESSION['username'];
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:$_URL_SITE/homePage.php");
}
else{
	//echo "Not seted: ". $_SESSION['username'];
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:$_URL_SITE/login.html");
    
}

?>
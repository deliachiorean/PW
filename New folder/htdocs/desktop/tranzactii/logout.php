<?php
session_start();

//require_once("config.php");
$_DB_servername = "localhost";
$_DB_name = "tranzactiidb";
$_DB_username = "root" ;
$_DB_password = "";
$_URL_SITE= "http://localhost/tranzactii";
echo "Sunteti logat ca $_SESSION[administrator]. <br><br>";

unset($_SESSION['username']);
unset($_SESSION['id']);

header ("Location: index.php");

?>
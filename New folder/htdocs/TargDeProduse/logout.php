<?php
session_start();
unset($_SESSION["loggedIn"]); 
//$_SESSION['loggedIn'] = false;
header("Location: index.php");
?>
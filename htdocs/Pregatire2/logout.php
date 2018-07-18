<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: logare.php"); // Redirecting To Home Page
}
?>
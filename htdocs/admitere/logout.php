<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: admin.html"); // Redirecting To Home Page
}
?>
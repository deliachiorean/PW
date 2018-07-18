<?php 

//logout
session_destroy();

//logged in return to index page
header('Location: dupaSignup.php');
exit;
?>
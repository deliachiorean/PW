<?php
$mysqli = new mysqli('localhost', 'Delia', 'delia12', 'web') or die("Can't connect");
$sql = "SELECT * FROM users LIMIT 3";
$result = $mysqli->query($sql);
$elements = array();
$elements = $result->fetch_all(MYSQLI_ASSOC);
$myJSON = json_encode($elements);
echo $myJSON;
?>
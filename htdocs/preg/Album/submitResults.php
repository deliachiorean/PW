<?php
session_start();
include 'db.php';
$name = $_POST['name'];
$time = $_POST['time'];
mysqli_query("INSERT INTO hall_of_fame(name, time) VALUES (" . "'$name'" . ", '$time')");

header("Location: game.php");
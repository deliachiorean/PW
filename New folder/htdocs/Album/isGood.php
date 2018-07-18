<?php
$resolvedIn = microtime(true) - $_POST['time'];
include 'db.php';
$result = mysqli_query($conn,"SELECT * FROM hall_of_fame WHERE time < '$resolvedIn'");
if ($result && mysqli_num_rows($result) > 3) {
	echo 'false';
} else {
	echo 'true';
}
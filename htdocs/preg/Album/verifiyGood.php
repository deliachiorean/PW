<?php
$imageName = $_POST['imageName'];
$description = $_POST['description'];
include 'db.php';
$result = mysqli_query($conn,"SELECT * FROM images WHERE fisier_imagine = '$imageName' AND descriere = '$description'");
if ($result && mysqli_num_rows($result) == 1) {
	echo 'valid';
} else {
	echo 'invalid';
}
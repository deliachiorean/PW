<?php
include_once 'config.php';

$id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = test_input($_POST["id"]);
}

$sql = "DELETE FROM mesaje WHERE id='$id'";
if (!mysqli_query($conn, $sql)) {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
else {
	echo "Succes!";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
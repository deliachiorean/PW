<?php
include_once 'config.php';

$id = $text = $secunde = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = test_input($_POST["id"]);
  $text = test_input($_POST["text"]);
  $secunde = test_input($_POST["secunde"]);
}

$sql = "INSERT INTO mesaje (id, text, secunde) VALUES ('$id', '$text', '$secunde')";
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
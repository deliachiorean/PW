<?php
include_once 'config.php';

$idOld = $idNew = $text = $secunde = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idOld = test_input($_POST["idOld"]);
  $idNew = test_input($_POST["idNew"]);
  $text = test_input($_POST["text"]);
  $secunde = test_input($_POST["secunde"]);
}

$sql = "UPDATE mesaje SET id='$idNew', text='$text', secunde='$secunde' WHERE id='$idOld'";
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
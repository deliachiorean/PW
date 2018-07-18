<?php

$username = "root";
$password = "";
$servername = "localhost";
$dbname="useri";

$grupa=$_POST["grupas"];


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$select="select nume,prenume,grupa,materie,nota from studenti where grupa='$grupa'";
		$select = $conn->prepare($select);
		$select->execute();
		$select->bind_result($nume,$prenume,$grupa,$materie,$nota);
		/*$rez=$conn->query($select);
		 while($row = $rez->fetch_array()) {

   foreach($row as $field) {
        echo ' <td> ' . htmlspecialchars($field) ;
    }

}}*/

echo "<h3>Lista studenti</h3>";
	echo "<br>";
while($select->fetch()){
	
	echo "<tr>";
	echo "<td>" . $nume . "</td> ";
	echo "<td>" . $prenume . "</td> ";
	echo "<td>" . $grupa . "</td> ";
	echo "<td>" . $materie . "</td> ";
	echo "<td>" . $nota . "</td> ";
	echo "<br>";



}



?>
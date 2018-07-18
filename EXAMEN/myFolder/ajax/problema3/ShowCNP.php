<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datepersonale";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}

$sql = "SELECT cnp FROM inregistrare";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc())
    {
        echo "<option>" . $row['cnp'] . "</option>";
    }
}
$conn->close();
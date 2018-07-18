<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trenuri";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}

$sql = "SELECT DISTINCT Plecare FROM tren";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    echo "<option> Plecare </option>";
    while ($row = $result->fetch_assoc())
    {
        echo "<option>" . $row['Plecare'] . "</option>";
    } 
}
$conn->close();
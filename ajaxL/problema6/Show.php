<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notebook";

$val = $_GET['val'];
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}

$sql = "SELECT DISTINCT $val FROM articole";
$result = $conn->query($sql);
if($result->num_rows > 0)
{   echo "<option value=''>$val</option>";
    while ($row = $result->fetch_assoc())
    {
        echo "<option>" . $row[$val] . "</option>";
    }
}
$conn->close();
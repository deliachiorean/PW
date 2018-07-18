<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tabela";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}
$result1 = "SELECT id FROM persoane";
$sql1 = $conn->query($result1);
$v = 0;
if($sql1->num_rows > 0)
{
    while($row1 = $sql1->fetch_assoc())
    {
        $v++;
    }
    echo $v;
}
$conn->close();
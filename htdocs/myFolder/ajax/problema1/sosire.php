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

$plecare = $_GET['plecare'];
$sql = "SELECT Distinct Sosire FROM tren WHERE Plecare=\"$plecare\"";
$result = $conn->query($sql);
if($result->num_rows > 0)
{   echo "<table>";
    echo "<tr>";
    echo "<th> Sosire</th>";
    echo "</tr>";
    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>" . $row['Sosire'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
$conn->close();
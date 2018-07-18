<?php


$sql = "SELECT * FROM articole";

$Producator = $_GET['producator'];
$Procesor = $_GET['procesor'];
$Ram = $_GET['ram'];
$HDD = $_GET['hdd'];
$PlacaVideo = $_GET['placavideo'];

if($Producator != "" || $Procesor != "" || $Ram != "" || $HDD != "" || $PlacaVideo != "")
    $sql .= " WHERE ";
if($Producator != "")
    $sql .= "Producator= '".$Producator."'";
if($Procesor != "")
    if($Producator != "")
        $sql .= " AND Procesor = '".$Procesor."'";
    else
        $sql .= " Procesor= '".$Procesor."'";
if($Ram != "")
    if($Producator != "" || $Procesor != "")
        $sql .= " AND Ram = '".$Ram."'";
    else
        $sql .= " Ram = '".$Ram."'";
if($HDD != "")
    if($Producator != "" || $Procesor != "" || $Ram != "")
        $sql .= " AND HDD = '".$HDD."'";
    else
        $sql .= " HDD = '".$HDD."'";
if($PlacaVideo != "")
    if($Producator != "" || $Procesor != "" || $Ram != "" || $HDD != "")
        $sql .= " AND PlacaVideo = '".$PlacaVideo."'";
    else
        $sql .= " PlacaVideo = '".$PlacaVideo."'";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notebook";
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}
$result = $conn->query($sql);
echo "<table>
<tr>
    <th>Producator</th>
    <th>Procesor</th>
    <th>Ram</th>
    <th>HDD</th>
    <th>Placa video</th>
</tr>";
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td >" . $row['Producator'] . "</td>";
        echo "<td>" . $row['Procesor'] . "</td>";
        echo "<td>" . $row['Ram'] . "</td>";
        echo "<td>" . $row['HDD'] . "</td>";
        echo "<td>" . $row['PlacaVideo'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
$conn->close();


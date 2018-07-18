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
$pers = $_GET['persoana'];

$sql = "SELECT Nume, Prenume, Telefon, Email FROM persoane Orders LIMIT 3 OFFSET $pers";
$result = $conn->query($sql);
echo "<table id='i'>
<tr>
    <th>Nume</th>
    <th>Prenume</th>
    <th>Telefon</th>
    <th>Email</th>
</tr>";
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
       // $id = $row['id'];
        echo "<tr>";
        echo "<td >" . $row['Nume'] . "</td>";
        echo "<td>" . $row['Prenume'] . "</td>";
        echo "<td>" . $row['Telefon'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
$result1 = "SELECT id FROM persoane";
$sql1 = $conn->query($result1);
$v =0;
if($sql1->num_rows > 0)
{
    while($row1 = $sql1->fetch_assoc())
    {
        $v++;
    }
    echo "<div id=\"lungime\">$v</div>";
}
$conn->close();

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

$cnp = $_GET['info'];
$sql = "SELECT cnp, Nume, Prenume, Telefon, Oras FROM inregistrare WHERE cnp=\"$cnp\"";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
    printf("{\"cnp\": [ ");
    $row = $result->fetch_assoc();
    //echo $row['Prenume'] ;
    printf("\"%s\",",$row['cnp']);
    printf("\"%s\",",$row['Nume']);
    printf("\"%s\",",$row['Prenume']);
    printf("\"%s\",",$row['Telefon']);
    printf("\"%s\",",$row['Oras']);
    printf(" ] }");
}else{
    echo "eroareee";
}
$conn->close();
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

$cnp = $_GET['cnp'];
$nume = $_GET['nume'];
$prenume = $_GET['prenume'];
$telefon = $_GET['telefon'];
$oras = $_GET['oras'];

if(! empty($cnp))
{
    $int = "UPDATE inregistrare SET Nume='$nume', Prenume='$prenume', Telefon='$telefon', Oras='$oras' WHERE cnp='$cnp'";
    if($conn->query($int) === TRUE)
        echo "S-a facut actualizarea.";
    else
        echo "Nu s-a reusit actualizarea.";
}
$conn->close();
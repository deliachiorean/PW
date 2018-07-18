<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tree-view";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: " .$conn->connect_error);
}

$sql = "SELECT id, Nume, idParinte FROM treeview";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
    printf("{\"tree\": [ ");
    while($row = $result->fetch_assoc())
    {
        printf("\"%s\",",$row['id']);
        printf("\"%s\",",$row['Nume']);
        printf("\"%s\",",$row['idParinte']);
    }

    printf(" ] }");
}else{
    echo "eroareee";
}
$conn->close();
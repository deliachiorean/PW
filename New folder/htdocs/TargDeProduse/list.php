<?php

session_start();
	

	$con = new mysqli('localhost','root','','produs');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));

//if (isset($_GET['nume']) && !empty($_GET['nume'])) {
    $query = "select * from produs ";
    $stmt = $con->prepare($query);
   // $stmt->bind_param('i',$_GET['nume']);
    $stmt->execute();

    $results = $stmt->get_result();
    $products = [];
    while ($row = $results->fetch_assoc()) {
        $products[]= $row;
    }

    echo json_encode($products);
//}

$con->close();


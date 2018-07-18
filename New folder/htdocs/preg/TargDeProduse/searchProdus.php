<?php

session_start();
	

	$con = new mysqli('localhost','root','','produse');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));

if (isset($_GET['nume']) && !empty($_GET['nume'])) {
    $query = "select * from produs where nume = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i',$_GET['nume']);
    $stmt->execute();

    $results = $stmt->get_result();
    $arr = [];
    while ($row = $results->fetch_assoc()) {
        $arr[] = $row;
    }

    echo json_encode($arr);
}

$con->close();



</body>
</html>


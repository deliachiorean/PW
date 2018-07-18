<?php
    include("config/config.php");

    $conn = new mysqli($_DB_servername, $_DB_username, $_DB_password, $_DB_name);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: ". $conn -> connect_error);
	}

    session_start();
    $sql = mysqli_query($conn, "SELECT id, userSource, userTarget, amount, date_time FROM transactions 
            WHERE userSource = '". $_SESSION['username'] ."' OR  userTarget = '". $_SESSION['username'] ."'");

    $rows = array();
    while($r = mysqli_fetch_assoc($sql)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
?>

<?php
    include("config.php");

    $conn = new mysqli($_DB_servername, $_DB_username, $_DB_password, $_DB_name);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: ". $conn -> connect_error);
	}

    session_start();
    // echo "ID : " . $_SESSION['id'];
    $sql = mysqli_query($conn, "SELECT sold FROM users WHERE id = ". $_SESSION["id"] );

    $rows = array();
    while($r = mysqli_fetch_assoc($sql)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
?>

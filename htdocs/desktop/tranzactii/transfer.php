<?php
    include("config.php");

    $conn = new mysqli($_DB_servername, $_DB_username, $_DB_password, $_DB_name);
	// Check connection

    if ($conn->connect_error) {
        die("Connection failed: ". $conn -> connect_error);
    }

    $id_tr = $conn->real_escape_string($_POST["id"]);
    $amount_tr = $conn->real_escape_string($_POST["amount"]);

    $sql1_tr = mysqli_query($conn, "SELECT username FROM users WHERE id = ". $id_tr);
    $r_tr = mysqli_fetch_assoc($sql1_tr);
    $user_tr = $r_tr["username"];
    //$currentSold_tr = $r_tr["sold"];


    session_start();
    $idUserCurrent = $_SESSION['id'];
    $sql1_sr = mysqli_query($conn, "SELECT username FROM users WHERE id = ". $idUserCurrent);
    $r_sr = mysqli_fetch_assoc($sql1_sr);
    $user_sr = $r_sr["username"];
    //$currentSold = $r_sr["sold"];

    //echo "Current sold: ". $currentSold . " Amount: ". $amount_tr;

    if($amount_tr > $currentSold){
        echo "Nu sunt destui bani in cont!";
        return false;
    }

    $newSold_sr = $currentSold - $amount_tr;
    $newSold_tr = $currentSold_tr + $amount_tr;
    //echo "sr: " . $newSold_sr ." tr: " . $newSold_tr;

    $sql4 = mysqli_query($conn, "UPDATE users SET sold = $newSold_sr WHERE id = $idUserCurrent");
    $sql5 = mysqli_query($conn, "UPDATE users SET sold = $newSold_tr WHERE id = $id_tr");

    $sql6 = mysqli_query($conn, "INSERT INTO transactions (userSource, userTarget, amount) 
                                       VALUES ('$user_sr', '$user_tr', '$amount_tr')");

    echo "Success!";
?>

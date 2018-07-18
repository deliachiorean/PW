<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }

    $user=$_SESSION['utilizator'];
    $nume = $_POST["nume"];
    $descriere = $_POST["descriere"];
    $producator = $_POST["producator"];
    $pret = $_POST["pret"];
    $cantitate = $_POST["cantitate"];

    $eroare = 1;

    $target_dir = "produse/";
    //$target_file = $target_dir . basename($_FILES["poza"]["name"]);
    $target_file = $target_dir . $nume . substr(basename($_FILES["poza"]["name"]),strlen(basename($_FILES["poza"]["name"]))-4,4);
    $numePoza = $target_file;
    if (move_uploaded_file($_FILES["poza"]["tmp_name"], $target_file)) {
        $eroare = 1;
    } else {
        $eroare = 0;
    }

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $dbname = "practicweb";

    // Create connection
    $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $nume = stripslashes($nume);
    $nume = mysqli_real_escape_string($conn, $nume);
    $descriere = stripslashes($descriere);
    $descriere = mysqli_real_escape_string($conn, $descriere);
    $producator = stripslashes($producator);
    $producator = mysqli_real_escape_string($conn, $producator);
    $pret = stripslashes($pret);
    $pret = mysqli_real_escape_string($conn, $pret);
    $cantitate = stripslashes($cantitate);
    $cantitate = mysqli_real_escape_string($conn, $cantitate);

    $sql = "INSERT INTO produse(nume, descriere, producator, pret, cantitate, poza) 
            VALUES ('$nume', '$descriere', '$producator', $pret, $cantitate, '$numePoza')";

    if ($conn->query($sql) !== TRUE) {
        $eroare = 0;
    }

    $conn->close();

    if ($eroare === 1)
        echo "Produsul a fost adaugat cu succes!";
    else
        echo "Produsul nu a putut fi adaugat!";
    header("location: index.php");
?>
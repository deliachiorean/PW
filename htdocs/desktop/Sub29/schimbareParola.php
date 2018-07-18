<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }

    $eroare = 1;

    $parolaVeche = $_POST["parolaVeche"];
    $parolaNoua = $_POST["parolaNoua"];

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $dbname = "pregatire2";

    // Create connection
    $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $parolaVeche = stripslashes($parolaVeche);
    $parolaNoua = stripslashes($parolaNoua);
    $parolaVeche = mysqli_real_escape_string($conn, $parolaVeche);
    $parolaNoua = mysqli_real_escape_string($conn, $parolaNoua);
    $utilizator = $_SESSION['utilizator'];

    $sql = "select * from users where utilizator='$utilizator'";

    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row["parola"] === $parolaVeche) {
            $eroare = 1;
        }
        else {
            $eroare = 0;
        }
    } else {
        $eroare = 0;
    }

    $conn->close();

    if ($eroare === 1) {
        // Create connection
        $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET parola = '$parolaNoua' WHERE utilizator = '$utilizator'";

        if ($conn->query($sql) !== TRUE) {
            $eroare = 0;
        }

        $conn->close();
    }

    echo $eroare;
?>
<?php
    session_start();
    if (!isset($_SESSION['utilizator'])) {
        header("location: login.php");
        die();
    }

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $dbname = "pregatire2";
    $utilizator = $_SESSION['utilizator'];
    $mesaj = "Avatarul a fost schimbat cu succes!<br/>";

    if (basename($_FILES["avatarNou"]["name"]) !== "" &&
            substr(basename($_FILES["avatarNou"]["name"]),strlen(basename($_FILES["avatarNou"]["name"]))-4,4) === ".jpg") {
        $target_dir = "avatar/";
        $target_file = $target_dir . $utilizator . substr(basename($_FILES["avatarNou"]["name"]),strlen(basename($_FILES["avatarNou"]["name"]))-4,4);
        $numePoza = $utilizator . substr(basename($_FILES["avatarNou"]["name"]),strlen(basename($_FILES["avatarNou"]["name"]))-4,4);
        if (move_uploaded_file($_FILES["avatarNou"]["tmp_name"], $target_file)) {
        } else {
            $mesaj = "Avatarul nu a putut fi schimbat!<br/>";
        }

        $conn = new mysqli($servername, $usernameBD, $passwordBD, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "UPDATE users SET numePoza = '$numePoza' WHERE utilizator = '$utilizator'";
        if ($conn->query($sql) !== TRUE) {
            $mesaj = "Avatarul nu a putut fi schimbat!<br/>";
        }

        $conn->close();
    }
    header("location: profile.php");
?>

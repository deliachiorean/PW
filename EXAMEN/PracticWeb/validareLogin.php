<?php
    session_start();
    $error='';
    if (isset($_POST['submit'])) {
        if (empty($_POST['utilizator']) || empty($_POST['parola'])) {
            $error = "Utilizatorul sau parola sunt invalide!";
        }
        else {
            $username=$_POST['utilizator'];
            $password=$_POST['parola'];

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

            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            $sql = "select * from users where utilizator='$username'";

            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if ($row["parola"] === $password) {
                    $_SESSION['utilizator'] = $username;
                    header("location: index.php");
                }
                else {
                    $error = "Utilizatorul sau parola sunt invalide!";
                }
            } else {
                $error = "Utilizatorul sau parola sunt invalide!";
            }

            $conn->close();
        }
        echo $error;
    }
?>
<?php
/**
 * Created by PhpStorm.
 * User: Deeathex
 * Date: 6/18/2018
 * Time: 2:51 PM
 */

session_start();
if (!isset($_SESSION['utilizator'])) {
    header("location: logare.php");
    die();
}

//iau intrebarea din GET
$intrebare=$_GET['intrebare'];
//iau utilizatorul de pe sesiune
$utilizator=$_SESSION['utilizator'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pregatire2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM questions INNER JOIN answers ON questions.id = answers.idquestion
                                INNER JOIN users ON users.user = answers.iduser
		WHERE idquestion=$intrebare ORDER BY data DESC";

$result=$conn->query($sql);

//incapsulam raspunsurile intr-un JSON
$valori=array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $valori[]=array($row["answer"],$row["dataCreare"],$row["user"],$row["avatar"]);
    }
}
$conn->close();

//tot ce scriu cu echo ajunge in javascript daca sunt in call ajax
echo json_encode($valori);
?>
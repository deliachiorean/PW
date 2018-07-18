<?php
/**
 * Created by PhpStorm.
 * User: Coste Claudia Ioana
 * Date: 6/16/2018
 * Time: 5:41 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p1";
session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function level1($conn)
{
    $sql = "SELECT * FROM `cuvinte` WHERE LENGTH(cuvant)=4";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    //echo "output".json_encode($outp);
    $index = rand(0, count($outp) - 1);
    $cuvant = (string)$outp[$index]["cuvant"];
    $_SESSION['cuvant'] = $cuvant;
    $_SESSION['nrIncercari'] = 0;
    $_SESSION['timp'] = 0;
    $_SESSION['nivel'] = 1;
    $_SESSION['deGhicit'] = 2;
    $_SESSION['litereGhicite'] = array();
    trimitereObiect();
    $stmt->close();
}

function trimitereObiect()
{
    $obj = (object)array();
    $obj->primaLitera = $_SESSION['cuvant'][0];
    $obj->ultimaLitera = $_SESSION['cuvant'][strlen($_SESSION['cuvant']) - 1];
    $obj->nivel = $_SESSION['nivel'];
    $obj->nrIncercari = $_SESSION['nrIncercari'];
    $obj->litereGhicite = $_SESSION['litereGhicite'];
    $obj->timp = $_SESSION['timp'];
    $obj->deGhicit=$_SESSION['deGhicit'];
    printf(json_encode($obj));
}

function nextLevel()
{
    $_SESSION['nivel']++;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "p1";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SESSION['nivel'] === 2) $length = 5;
    else $length = 6;
    $sql = "SELECT * FROM `cuvinte` WHERE LENGTH(cuvant)=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$length);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    //echo "output".json_encode($outp);
    $index = rand(0, count($outp) - 1);
    $cuvant = (string)$outp[$index]["cuvant"];
    $_SESSION['cuvant'] = $cuvant;
    if ($_SESSION['nivel'] == 2) {
        $_SESSION['deGhicit'] = 3;
    } else {
        $_SESSION['deGhicit'] = 4;
    }
    unset($_SESSION['litereGhicite']);
    $_SESSION['litereGhicite'] = array();
    trimitereObiect();
    $stmt->close();
    $conn->close();
}

if (!isset($_SESSION['cuvant'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Connected to MySQL";
    }
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        level1($conn);
        $conn->close();
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
//        echo "aici";
        if (isset($_GET["litera"])) {
//            echo "aici";
            $litera = test_input($_GET['litera']);
            $cuvant = $_SESSION['cuvant'];
            //a introdus o literaaa
            $poz = strpos($cuvant, $litera,1);
            $_SESSION['nrIncercari'] = $_SESSION['nrIncercari'] + 1;
            if ($poz > 0 && $poz < strlen($cuvant) - 1) {
                //a ghicit o litera!!!
                $_SESSION['deGhicit']--;
                $obj = $_SESSION['litereGhicite'];
                $obj_litera = (object)array();
                $obj_litera->pozitie = $poz;
                $obj_litera->litera = $litera;
                array_push($obj, $obj_litera);
                $_SESSION['litereGhicite'] = $obj;
                if ($_SESSION['deGhicit'] == 0) {
                    if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) {
                        nextLevel();
                        return;
                    } else {
                        //nivel 3 terminat introducere in HALL OF FAME
                        header("Location: numeHall.html");
                        return;
                    }
                }

            } else {
                //nu a ghicit litera!!!
            }
            trimitereObiect();

        } else {
            trimitereObiect();
        }
    }
}

?>


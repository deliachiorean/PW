<?php

$lp=$_POST["plecare"];
$ls=$_POST["sosire"];
$var=$_POST["varianta"];
echo "Ati selectat lista trenurilor din ";
echo $lp;
echo " spre ";
echo $ls;
echo " cu ruta ";
echo $var;
echo "<br>";
echo "<br>";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trenuri";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($var == "directa"){
$sql = "SELECT * FROM tren where localitatep = '".$lp."' and localitates='".$ls."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_array()) {
echo "Numar tren: " . $row["nrtren"]. " Tip: " . $row["tiptren"]. " Din: " . $row["localitatep"]. " Spre: " . $row["localitates"]." Plecare la: " . $row["orap"]." Sosire la: " . $row["oras"]."<br>";
    }
} else {
    echo "Nu exista trenuri pe aceasta ruta!";
}
$conn->close();
}
 
elseif($var=="directa" || $var=="intermediara"){

/*SELECT 
t1.nrtren,t1.tiptren,t1.localitatep,t1.localitates,t1.orap,t1.oras,t2.nrtren,t2.tiptren,t2.localitatep,t2.localitates,t2.orap,t2.oras
FROM tren AS t1
JOIN tren AS t2 
  ON t1.localitates = t2.localitatep
where t1.localitates='Bucuresti' and t1.localitatep='Budapesta'


*/
	//SELECT * FROM tren as t1 left JOIN tren as t2 ON (t1.localitates = t2.localitates and t1.localitates=t2.localitatep) where t1.orap>=t2.oras
$sql = "SELECT 
t1.nrtren,t1.tiptren,t1.localitatep,t1.localitates,t1.orap,t1.oras,t2.nrtren,t2.tiptren,t2.localitatep,t2.localitates,t2.orap,t2.oras
FROM tren  t1
INNER JOIN tren  t2 
where t1.localitatep='".$lp."'and t2.localitates='".$ls."'and t2.localitatep=t1.localitates and t1.oras<t2.orap";

$sql1 = "SELECT * FROM tren where localitatep = '".$lp."' and localitates='".$ls."'";
$result1 = $conn->query($sql1);

//$sql="SELECT a.nrtren,a.tiptren,a.localitatep, a.orap, a.oras, a.localitates,b.nrtren, b.tiptren,b.localitatep, b.orap, b.oras, b.localitates FROM tren a INNER JOIN tren b WHERE a.localitatep='".$lp."'AND b.localitates='".$ls."'AND a.localitates=b.localitatep AND a.oras<b.orap'";

/*$sql = "SELECT a.tiptren,a.localitatep, a.orap, a.oras, a.localitates, b.tiptren,b.localitatep, b.orap, b.oras, b.localitates FROM tren a INNER JOIN tren b WHERE a.localitatep='".$lp."'AND b.localitates='".$ls."'AND a.localitates=b.localitatep AND a.oras<b.orap";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $lp, $ls);
		$stmt->execute();
		$stmt->bind_result($atip, $aorasp,$aorap, $aoras,$aorass,$btip, $borasp,$borap, $boras,$borass);

*/

$result = $conn->query($sql);
$result1 = $conn->query($sql1);
if ($result->num_rows > 0) {
    while($row = $result->fetch_array()) {
/*echo "Numar tren: " . $row["t1.nrtren"]. " Tip: " . $row["t1.tiptren"]. " Din: " . $row["t1.localitatep"]. " Spre: " . $row["t1.localitates"]." Plecare la: " . $row["t1.orap"]." Sosire la: " . $row["t1.oras"]."<br>"."Numar tren: " . $row["t2.nrtren"]. " Tip: " . $row["t2.tiptren"]. " Din: " . $row["t2.localitatep"]. " Spre: " . $row["t2.localitates"]." Plecare la: " . $row["t2.orap"]." Sosire la: " . $row["t2.oras"]."<br>";
    }
} else {
    echo "Nu exista trenuri pe aceasta ruta!";
}
$conn->close();
}*/
echo ' <tr> ';
   foreach($row as $field) {
        echo ' <tr> ' . htmlspecialchars($field) . ' </tr> ';
    }
    echo ' </tr> ';

}}

if ($result1->num_rows > 0) {
    while($row = $result1->fetch_array()) {

echo ' <tr> ';
   foreach($row as $field) {
        echo ' <tr> ' . htmlspecialchars($field) . ' </tr> ';
    }
    echo ' </tr> ';

}}


else{
	echo "Nu exista trenuri pe aceasta ruta!";
}
}

?>
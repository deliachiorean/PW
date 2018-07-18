<?php 

	$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trenuri";
 // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected to MySQL";
    }
$plecare = $_POST["plecare"];
$sosire = $_POST["sosire"];

echo "<h4>Trenuri directe</h4>";
$sql = "select * from tren where Plecare='".$plecare."' and Sosire='".$sosire."'";
$result = $conn->query($sql);
if($result->num_rows>0){
	echo "<table><tr>
		<th>Id</th>
		<th>Plecare</th>
		<th>Sosire</th>
		<th>Ora plecare</th>
		<th>Ora Sosire</th>
		</tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr>
        	<td>".$row["id"]."</td>
        	<td>".$row["Plecare"]."</td>
        	<td>".$row["Sosire"]."</td>
        	<td>".$row["OraPlecare"]."</td>
        	<td>".$row["OraSosire"]."</td>
        	</tr>";
    }
    echo "</table>";
}
else{
	echo "Nu sunt inca trenuri directe intre aceste localitati";
}

if(!isset($_POST['interm'])){
	echo "<h4>Trenuri intermediare</h4>";
	$sql = "select distinct T1.id as id, T1.Plecare as Plecare, T1.OraPlecare as OraPlecare, T1.Sosire as Intermediar, T1.OraSosire as oraInt,
				T2.OraPlecare as oraIntP, T2.Sosire as Sosire, T2.OraSosire as OraSosire
		 from tren T1 inner join tren T2 on T1.Sosire=T2.Plecare
		 where T1.Plecare='".$plecare."' and T2.Sosire='".$sosire."'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		echo "<table ><tr>
			<th>id</th>
			<th>Plecare</th>
			<th>Ora plecare</th>
			<th>Loc. intermediara</th>
			<th>Ora sosire</th>
			<th>Ora plecare</th>
			<th>Sosire</th>
			<th>Ora Sosire</th>
			</tr>";
		while($row = $result->fetch_assoc()) {
	        echo "<tr>
	        	<td>".$row["id"]."</td>
	        	<td>".$row["Plecare"]."</td>
	        	<td>".$row["OraPlecare"]."</td>
	        	<td>".$row["Intermediar"]."</td>
	        	<td>".$row["oraInt"]."</td>
	        	<td>".$row["oraIntP"]."</td>
	        	<td>".$row["Sosire"]."</td>
	        	<td>".$row["OraSosire"]."</td>
	        	</tr>";
	    }
	    echo "</table>";
	}
	else{
		echo "Nu sunt inca trenuri intermediare intre aceste localitati";
	}
}


    $conn->close();
?>
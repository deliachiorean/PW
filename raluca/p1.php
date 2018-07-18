<!DOCTYPE html>
<html>
<head>
	<title>CFR</title>
</head>
<body>
	<?php
$servername = "localhost";
$username = "Ralu";
$password = "raluca1997";
$dbname = "phplab";
 // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Connected to MySQL";
    }
	?>
	
	<form action="cauta.php" method="post">
		<p>
			Localitate plecare:
			<?php
			$sql = "select distinct Plecare from Trenuri";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				echo "<select id='plecare' name='plecare'>";
				while($row=$result->fetch_assoc()){
					echo "<option value='".$row["Plecare"]."'>".$row["Plecare"]."</option>";
				}
				echo "</select>";
			}
			?>
		</p>
		<p>
			Localitate sosire:
			<?php 
			$sql = "select distinct Sosire from Trenuri";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				echo "<select id='sosire' name='sosire'>";
				while($row=$result->fetch_assoc()){
					echo "<option value='".$row["Sosire"]."'>".$row["Sosire"]."</option>";
				}
				echo "</select>";
			}
			?>
		</p>
		<input type="checkbox" name="ch"> Doar trenuri directe <br><br>
		<input type="submit" value="Cauta"> 
	</form>
</body>
</html>
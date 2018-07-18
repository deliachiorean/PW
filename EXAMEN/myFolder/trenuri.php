<!DOCTYPE html>
<html>
<head>
	<title>trenuri</title>
</head>
<body>
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
    ?>

	<form action="cautareTren.php" method="post">
		<p>

  		Localitate Plecare: 
  		<?php
  		$sql = "select distinct Plecare from tren";
  		$result=$conn->query($sql);
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

		Localitate Sosire: 
		<?php
		$sql = "select distinct Sosire from tren";
		$result=$conn->query($sql);
		if($result->num_rows>0){
		echo "<select id='sosire' name='sosire'>";
		while($row=$result->fetch_assoc()){
				echo "<option value='".$row["Sosire"]."'>".$row["Sosire"]."</option>";
			}
			echo "</select>";
		}
		?>
  		</p>
 		<input type="checkbox" name="interm">Doar trenuri directe
 		<br>
  		<input type="submit" value="cautaTrenuri">
</form>
	

</body>
</html>
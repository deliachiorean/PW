<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("td").click(function(e){
		
		descriere=$(e.target).text();
		//cand da click pe descriere se seteaza descrierea si creste nrdeClickuri
		alert(descriere);

	   //this.style.backgroungColor='Red';
   		 this.style.backgroundColor ='Red' ;
});
});
</script>

<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="problema30";
$conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


echo "<form method='post' action='profile.php' >";   
        echo "Titlu :<input type='text' name='titlu'> ";
        echo "<br>";
        echo "Data Spectacol:<input type='date' name='dateSpectacol'>";
        echo "<br>";
        echo "Ora Spectacol:<input type='time' name='oraSpectacol'>";
        echo "<br>";
        echo "<input type='submit' id='submit' name='submit' value='Adaugare Spectacol'> ";
        echo "</form>";
      if (isset($_POST['submit'])) {
        $titlu=$_POST["titlu"];
        $dateEveniment=$_POST["dateSpectacol"];
        $oraEveniment=$_POST["oraSpectacol"];
        $sql="INSERT INTO spectacol values('$titlu','$dateEveniment','$oraEveniment')";
        $result=$conn->query($sql);
      }
/*
echo "<form action='MainWindow.php' method='post'>";
echo "<select id='producator' name='producator'>";
if ($result->num_rows>0){

	while($row=$result->fetch_assoc()){
    		echo "Producatori: <option>".$row["producator"]."</option>";
    	}
    }else{
    	echo "Nu sunt producatori";
    }
    echo "</select>";*/
$sql="SELECT  titlu from spectacol";
$result=$conn->query($sql);
echo "<form method='post' action='profile.php' >";   
        echo "Spectacol :<select id='titlu' name='titlu'> ";
        echo "<br>";
        if ($result->num_rows>0){

		while($row=$result->fetch_assoc()){
    		echo "<option>".$row["titlu"]."</option>";
    	}
    }else{
    	echo "Nu sunt spectacole";
    }
    echo "</select>";
    echo "<input type='submit' id='submit2' name='submit2' value='Afisare Rezervari'> ";
    echo "</form>";
    if (isset($_POST['submit2'])) {
        $titlu=$_POST["titlu"];
        echo $titlu;
        //$dateEveniment=$_POST["dateSpectacol"];
        //$oraEveniment=$_POST["oraSpectacol"];
        //$sql="INSERT INTO spectacol values('$titlu','$dateEveniment','$oraEveniment')";
        //$result=$conn->query($sql);
      }
?>
</body>
</html>
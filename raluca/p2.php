<?php
$servername = "localhost";
$username = "Ralu";
$password = "raluca1997";
$dbname = "phplab";

//$rec_limit = 1;
$rec_limit =  $_GET['s'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	 if( isset($_GET{'page'} ) ) {
        $page = $_GET{'page'} + 1;
        $offset = $rec_limit * $page ;
     }else {
        $page = 0;
        $offset = 0;
     }

    
	
     $sql = "SELECT id, denumire, pret,descriere,cantitate ". 
        "FROM Produse ".
        "LIMIT $offset, $rec_limit";

     $retval =  $conn->query($sql);
	 $rec_count=$total=mysqli_num_rows($retval);
	  $left_rec = $rec_count - ($page * $rec_limit);
	  if(! $retval ) {
        die('Could not get data: ' . connect_error());
     }
if ($retval->num_rows > 0) {
    // output data of each row
    while($row = $retval->fetch_assoc()) {
         echo  $row["id"]. "<br>".$row["denumire"]. "<br>".$row["pret"]. "<br>".$row["descriere"]. "<br>".$row["cantitate"]. "<br>";
		 echo "<br>";
    }
} else {
    echo "0 results";
}
if( $page > 0) {
$last = $page - 2;
echo "<a href =\"p2.php?page=$last&s=$rec_limit\">Last</a>";
echo "<br>";
echo "<a href =\"p2.php?page=$page&s=$rec_limit\">Next</a>";

}else if( $page == 0 ) {
$page = $page + 0;
echo "<a href = \"p2.php?page=$page&s=$rec_limit\">Next</a>";

}else if( $left_rec < $rec_limit ) {

$last = $page - 2;
echo "<a href = \"p2.php?page=$last&s=$rec_limit\">Last</a>";

}
$conn->close();

?>
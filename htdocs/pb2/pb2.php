<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Produse";

//$limit = 1;
$limit =  $_GET['s'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	 if( isset($_GET{'page'} ) ) {
        $page = $_GET{'page'} + 1;
        $offset = $limit * $page ;
     }else {
        $page = 0;
        $offset = 0;
     }

    
	
     $sql = "SELECT Id,Denumire,Marime,Stoc,Pret ". 
        "FROM Articole ".
        "LIMIT $offset, $limit";

     $retval =  $conn->query($sql);
	 $rec_count=$total=mysqli_num_rows($retval);
	  $left_rec = $rec_count - ($page * $limit);
	  if(! $retval ) {
        die('Could not get data: ' . connect_error());
     }
if ($retval->num_rows > 0) {

	echo "ID" . " &nbsp; &nbsp; &nbsp;" . "Denumire" . " &nbsp; &nbsp; &nbsp;" . "Marime" . " &nbsp; &nbsp; &nbsp;" . "Stoc" . "&nbsp; &nbsp; &nbsp; " . "Pret" . "<br>";
    while($row = $retval->fetch_assoc()) {
         echo  $row["Id"]. "&nbsp; &nbsp; &nbsp; " .$row["Denumire"]. "&nbsp; &nbsp; &nbsp;" .$row["Marime"]. "&nbsp; &nbsp; &nbsp; ".$row["Stoc"]. " &nbsp; &nbsp; &nbsp;".$row["Pret"]. " ";
		 echo "<br>";
	
    }
} else {
    echo "No more articles";
	echo"<br>";

}
if( $page > 0) {
$Previous = $page - 2;
echo "<a href =\"pb2.php?page=$Previous&s=$limit\">Previous</a>";
echo "<br>";
echo "<a href =\"pb2.php?page=$page&s=$limit\">Next</a>";

}else if( $page == 0 ) {
$page = $page + 0;
echo "<a href = \"pb2.php?page=$page&s=$limit\">Next</a>";

}else if( $left_rec < $limit ) {

$Previous = $page - 2;
echo "<a href = \"pb2.php?page=$Previous&s=$limit\">Previous</a>";

}
$conn->close();

?>
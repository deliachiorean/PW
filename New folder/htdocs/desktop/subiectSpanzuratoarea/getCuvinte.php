<?php
function get_connection()
{
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "subiectspanzuratoarea";

    $connection=mysqli_connect($servername,$username,$password,$dbname);	
	if($connection->connect_error)
		die("Connection failed: " .$connection->connect_error);
	return $connection;
}

session_start();
$idConectat=$_SESSION['id'];
if(!isset($idConectat))
	die("Nu aveti acces la aceasta pagina");
else
{

	$connection=get_connection();
	$sqlCommand="SELECT id,cuvant FROM `cuvinte`";	
	$statement=$connection->prepare($sqlCommand);
	$statement->execute();
	$statement->bind_result($id,$cuvant);
	$statement->store_result();

	$detalii=array();
	while($statement->fetch())
	{

		$detalii[]=array('id'=>$id,'cuvant'=>$cuvant);   	
	}

	$statement->close();
	$connection->close();
	echo json_encode($detalii);
}
?>
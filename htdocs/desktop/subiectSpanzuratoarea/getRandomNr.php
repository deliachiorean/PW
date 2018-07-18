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

	$connection=get_connection();
	$sqlCommand="SELECT id,cuvant FROM `cuvinte` where cuvant like '____'";	
	$statement=$connection->prepare($sqlCommand);
	$statement->execute();
	$statement->bind_result($id,$cuvant);
	$statement->store_result();

	$detalii=array();
	while($statement->fetch())
	{
		$detalii[]=array('id'=>$id,'cuvant'=>$cuvant);   	
	}
	$random_keys=array_rand($detalii,1);
	$statement->close();
	$connection->close();

	session_start();
	$dataStart=new DateTime();
	$_SESSION['dataStart']=$dataStart;
	$index_random=rand(0,sizeof($detalii)-1);
	$pereche=$detalii[$index_random];

	$x=strlen($pereche["cuvant"]);
	$init=$pereche["cuvant"];
	// $first = substr($pereche["cuvant"], 1);
	// $last = substr($pereche["cuvant"], -1);
	// $x=substr($x, 0, -1) . $last;
	// $x=substr($x, 0, 1) . $fist;
	$cuvant="";
	for ($i = 0; $i < $x; $i++) {
    	if($i==0 || $i==3)
    		$cuvant=$cuvant.$init[$i];
    	else $cuvant=$cuvant."~";

	} 
	$pereche['cuvant']=$cuvant;


	echo json_encode($pereche);

?>
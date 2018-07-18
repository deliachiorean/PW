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


	$id=$_POST['idCuvant'];
	$cuvant=$_POST['cuvant'];
	$litera=$_POST['litera'];

	session_start();
	$incercari=0;
	if(isset($_SESSION['incercari']))
		$incercari=$_SESSION['incercari'];


	$connection=get_connection();
	$sqlCommand="SELECT cuvant FROM `cuvinte` where id=?";	
	$statement=$connection->prepare($sqlCommand);
	$statement->bind_param('i',$id);
	$statement->execute();
	$statement->bind_result($cuvantOriginal);
	$statement->store_result();

	//$detalii=array();
	while($statement->fetch())
	{
		if($cuvant==$cuvantOriginal)
		{
			$now=new DateTime();
			$incercari=0;
			$start=$_SESSION['dataStart'];
			$_SESSION['durata']=$now-$start;
			echo json_encode("ai ghicit");

		}
		else
		{
			$incercari++;
			$x=strlen($cuvantOriginal);
			$cuvantReturn=$cuvant;
			for($i=0;$i<$x;$i++)
			{
				if($cuvantOriginal[$i]==$litera)
					$cuvantReturn[$i]=$litera;
			}
			echo json_encode($cuvantReturn);	

		}
		$_SESSION['incercari']=$incercari;
		//$detalii[]=array('id'=>$id,'cuvant'=>$cuvant);   	
	}

	$statement->close();
	$connection->close();
	//echo json_encode($detalii);

?>
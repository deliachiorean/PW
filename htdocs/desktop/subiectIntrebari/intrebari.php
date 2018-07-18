<?php

	if(isset($_GET['submit']))
	{
		$nr=0;
		$connection=mysqli_connect("127.0.0.1","root","","subiect32015");	
		if($connection->connect_error)
			die("Connection failed: " .$connection->connect_error);

		$countAll="select count(*) as 'all' from intrebari";
		$total=$connection->query($countAll);
		$nrAll=$total->fetch_assoc();
		

		$sqlCommnad="select * from intrebari limit 3 offset ".$start;
		$result=$connection->query($sqlCommnad);
		if($result->num_rows>0)
		{	
			
			while($row = $result->fetch_assoc()) 
			{
	        	echo "<div class='intrebare' data-id=".$row["id"].">".$row["intrebare"]."<ul><li>".$row["r1"]."</li><li>".$row["r2"]."</li><li>".$row["r3"]."</li></ul></div>"; 	
	        	$nr+=1;
	    	}
    	}

    	$connection->close();

    	//if($nr-3>=0)
		// 		echo "<a href=prev.php?start=".$nr ."&step=3>Back</a> ";
		// if($nr!=$nrAll["all"])
		// 	echo "<a href=next.php?start=".$nr."&step=3>Next</a>";
		echo "<a href=ex2.html>Back</a> ";
		// echo "<button type='button' name='next' onclick='prevJS(".$nr.",3)'>Prev</button>";
	if($nr!=$nrAll["all"])
		//echo "<a href=next.php?start=".$nr."&step=".$step.">Next</a>";
		echo "<button type='button' name='next' onclick='nextJQ(".$nr.",3)'>Next</button>";
	}

	
?>
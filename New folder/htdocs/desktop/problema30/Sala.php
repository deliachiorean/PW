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

<?php
$rows = 15;
$cols = 15;
$currentnr;
//$booked = array(1, 4, 100, 199);

echo "<table border='1'>";
for($tr=1;$tr<=$rows;$tr++){ // Going through every row
    echo "<tr>";
        for($td=1;$td<=$cols;$td += 2){ // Going through every column (2 at a time)
            $currentnr = ($tr * 10 - 10 + $td); // Calculates the current nr
            // ---------This id \/
            echo "<td  style='background-color:green; ><div id='free'><p>".$currentnr."</p></div></td>";
            echo "<td style='background-color:green;'><div id='free'><p>".($currentnr + 1)."</p></div></td>";
        }
    echo "</tr>";
}
echo "</table>";
echo '<br /><a href="index.php">Autentificare</a>';
?>
<?php

$servername = "localhost";
$username = "Ralu";
$password = "raluca1997";
$dbname = "phplab";
 // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die;
}

$query = mysqli_query($connection,"SELECT id, titlu, imagine, voturi FROM poze ORDER BY voturi DESC");

if (!$query){
	echo "Failed to retrieve data! ";
	die;
}

if (isset($_POST["voturi"]) && $_POST["captcha"] == 4){
	$id = mysqli_real_escape_string($connection, $_GET["id"]);
	
	$q = mysqli_query($connection, 'UPDATE poze SET voturi = voturi+1 WHERE id = "'.$id.'"');
	
	header('Location: p6.php');
}
?>

<html>
    <head>
        <title>Concurs poze</title>
        
      
    </head>
    <body>
        <div class="main_wrapper">
			
			<?php while($row = mysqli_fetch_assoc($query)){ ?>
                <div class="post">
                    <div>
                        <h2><?php echo $row["titlu"] . " (" . $row["voturi"] . ")"; ?></h2>
                    </div>
                    <figure class="image"><img src="<?=$row["imagine"]?>.jpg" alt="<?=$row["titlu"]?>" /></figure>
                    <div class="comment">
                        <form method="POST" action="p6.php?id=<?=$row["id"]?>">
                           
                            <div>Cat face 2+2? <input type="text" name="captcha" value=""/><input type="submit" name="voturi" value="Vote" /></div>
                        </form>
                    </div>
                </div>
			<?php } ?>
        </div>
    </body>
</html>
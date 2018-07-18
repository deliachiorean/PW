<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fotografii";
    $connection = new mysqli($servername, $username, $password, $dbname);

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die;
}

$query = mysqli_query($connection,"SELECT id, titlu, imagine, voturi FROM posturi ORDER BY voturi DESC");

if (!$query){
	echo "Failed to retrieve data! ";
	die;
}

if (isset($_POST["voturi"]) && $_POST["captcha"] == "ceva"){
	$id = mysqli_real_escape_string($connection, $_POST["id"]);
	
	$q = mysqli_query($connection, 'UPDATE posturi SET voturi = voturi+1 WHERE id = "'.$id.'"');
	
}
?>
<html>
    <head>
        <title>Poze</title>
        <style>
            
        img{
            width: 500; height: 400;
        }

        h1{
            text-align: center;
        }
        </style>
      
    </head>
    <body>
         <h1>Balloon Events Oradea most liked products contest</h1>
        <div class="main">
			
			<?php while($row = mysqli_fetch_assoc($query)){ ?>
                <div class="post">

                    <div>
                        <h3><?php echo $row["titlu"] . " (" . $row["voturi"] . ")"; ?></h3>
                    </div>
                    <figure class="image"><img src="<?=$row["imagine"]?>.jpg" alt="<?=$row["titlu"]?>" /></figure>
                    <div class="comment">
                        <form method="POST" action="poze.php?id=<?=$row["id"]?>">
                           
                            <div>Scrie ceva <input type="text" name="captcha" value=""/><input type="submit" name="voturi" value="Vote" /></div>
                        </form>
                    </div>
                </div>
			<?php } ?>
        </div>
    </body>
</html>
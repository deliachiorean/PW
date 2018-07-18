<!DOCTYPE html>

<?php
	session_start();
	$_SESSION['loggedIn'] = false;
	$con = new mysqli('localhost','root','','produse');
	if (!$con) 
		die('Could not connect: ' . mysqli_error($con));
	
	
	if (isset($_POST['user']) && isset($_POST['password'])) {
		$unsafe_password = $_POST['password'];
		// To protect MySQL injection for Security purpose
			$username = stripslashes($$_POST['user']);
			$password = stripslashes($_POST['password']);
			$username = mysqli_real_escape_string($conn,$_POST['user']);
			$password = mysqli_real_escape_string($conn,$_POST['password']);
		$query = "SELECT * FROM admin WHERE user = '{$_POST['user']}' AND password = ?";
		
		if($stmt = $con->prepare($query))
		{
			$stmt->bind_param("s",$unsafe_password);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->num_rows > 0) {
				$_SESSION['loggedIn'] = true;
				header('Location: adminMain.php');
				$stmt->close();
				
			} else {
				$_SESSION['loggedIn'] = false;
				$stmt->close();
				
			}
		}
		else
		{
			
		}
		
    }
	$con->close();
?>

<html>
<head>
    <title>Main window</title>
</head>
<body>


<div align="center">
    <h3>Click <a href="/TargDeProduse/produse.php">here</a> if you want to see the products</h3>
    <br/>
    <h3>If you are the administrator, please log in using this form!</h3>
</div>
<div align="center">
    <div class="login.php">
        <h1>Login</h1>
        <form action="index.php" method="post">
            <h4>Username : </h4><input type="text" name="user"><br>
            <h4>Password : </h4><input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
    </div>
</div>
</body>
</html>
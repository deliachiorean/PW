<?php
session_start();

$connection = mysqli_connect("localhost","root","","form");
$errorMessage = null;
if(!$connection)
	die("Connection failded");
if (isset($_POST["submit"])) {
if(isset($_POST["username"]))
	$username = $_POST["username"];
if(isset($_POST["password"]))
	$password = $_POST["password"];


try{
	
	if($_POST["captcha"] == 4){
$sql = "select * from tbl_login where first_name = '$username'";

$result = mysqli_query($connection,$sql);

if(!$row = mysqli_fetch_assoc($result))
	$errorMessage= "Username or password incorect";
else
{
	$hasedPwdCheck = password_verify($password, $row['password']);
	 if($hasedPwdCheck == false){
          header("Location: ../index.php?login=error");
          exit();
        }
	//if($_POST["captcha"] == 4){
	$_SESSION["loggeduser"] = $username;
	header("Location: firstPage.php");
	//}
	//else $errorMessage= "Cod captcha gresit";
}
	}
	else $errorMessage= "Cod captcha gresit";


?>
 <?php
    } catch (SQLException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form name="myForm" role="form"  action="dupaSignup.php" method="post" autocomplete="off">
				<h2>Please Login</h2>
				 <?php if (null !== $errorMessage): ?>
            <p class="errorMessage"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
				<hr>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>
				<hr>
				
				<div class= "form-group">
				Cat face 2+2?
				<input type="text" name="captcha" value=""/></div>
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>

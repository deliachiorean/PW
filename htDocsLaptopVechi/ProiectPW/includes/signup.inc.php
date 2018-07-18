<?php
 if(isset($_POST['submit']))
 {
   include_once 'dbh.inc.php';
   $first = mysqli_real_escape_string($conn, $_POST['first']);//nu lasam sa faca injection.
   $last = mysqli_real_escape_string($conn, $_POST['last']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $uid = mysqli_real_escape_string($conn, $_POST['uid']);
   $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
   //error handlers
   //check for emty field
   if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd))
   {
     header("Location: ../signup.php?signup=empty");
     //red fields
     exit();

   }else {
      //check if input chars are valid
      if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last))
      {
        header("Location: ../signup.php?signup=invalid");
        //red fields
        exit();
      }else{
        //check email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{	
			header("Location: ../signup.php?signup=invalid_email");
			//red fields
			exit();
		}
        else{
          $sql = "SELECT * FROM users WHERE user_uid='$uid'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if($resultCheck > 0)
          {
            //exista deja un user cu acel Username
            header("Location: ../signup.php?signup=username_taken");
            //red fields
            exit();
          }else{
            //hash the password and make it unregonazble
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            //insert the user into the db
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pawd) VALUES ('$first', '$last', '$email', '$uid' '$hashedPwd') ";
            mysqli_query($conn, $sql);
            header("Location: ../signup.php?signup=success");
            exit();
		  }
        }
      }
   }

 }else{
   header("Location: ../signup.php");
   exit();
 }

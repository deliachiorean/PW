<?php
	$nume=$_POST["nume"];
	$prenume=$_POST["prenume"];
	$adresa=$_POST["adresa"];
	$email=$_POST["email"];
	$telefon=$_POST["telefon"];
	$dataEfectuare=date('Y-m-d H:i:s');

	$identificator=random_int(100000,1000000);

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pregatire1";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$nume=mysqli_real_escape_string($conn, $nume);
	$prenume=mysqli_real_escape_string($conn, $prenume);
	$adresa=mysqli_real_escape_string($conn, $adresa);
	$email=mysqli_real_escape_string($conn, $email);
	$telefon=mysqli_real_escape_string($conn, $telefon);

	$sql = "INSERT INTO cereri (id, nume, prenume, adresa, email, telefon, dataEfectuare)
	VALUES ('$identificator', '$nume', '$prenume', '$adresa', '$email', '$telefon', '$dataEfectuare')";

	/*
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	*/

	if ($conn->query($sql) !== TRUE) {
	    echo "Cererea nu a putut fi realizata!";
	    return;
	}

	$conn->close();

	$mail_body = "Identificatorul cererii dumneavoastra este $identificator";
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'andreeaciforac@gmail.com';					//Sets SMTP username
	$mail->Password = 'dansfrancez7';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'andreeaciforac@gmail.com';			//Sets the From email address for the message
	$mail->FromName = 'Andreea';					//Sets the From name of the message
	$mail->AddAddress($email, $nume);		//Adds a "To" address			
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->Subject = 'Verificare cerere';			//Sets the Subject of the message
	$mail->Body = $mail_body;							//An HTML or plain text message body


	if($mail->Send()) {
	}
	else {
	    echo "Cererea nu a putut fi realizata!";
	    return;
	}

	$target_dir="Cereri/";
	//$target_file=$target_dir.basename($_FILES["cererePDF"]["name"]); //CALE + NUMELE FISIERULUI
	$target_file=$target_dir.$identificator.substr(basename($_FILES["cererePDF"]["name"]),strlen(basename($_FILES["cererePDF"]["name"]))-4,4);

	if (move_uploaded_file($_FILES["cererePDF"]["tmp_name"], $target_file)){
		echo "Cererea a fost trimisa cu succes!<br/>";
		echo "Identificator: ".$identificator."<br/>";
		echo "A fost trimis pe mail identificatorul.<br/>";
	}
	else {
		echo "Cererea NU a fost trimisa cu succes!";
	}

	$cookie_name="userCerere";
	$cookie_value=$email;
	setcookie($cookie_name, $cookie_value,time()+(86400*30),"/"); //available in the entire website
?>
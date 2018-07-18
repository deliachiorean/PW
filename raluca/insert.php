<?php
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "webdb";
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$idMaterie = $_POST["idMaterie"];
		$idStudent = $_POST["idStudent"];
		$nota = $_POST["nota"];
		$sql = "insert into note (idMaterie, idUser, nota) values ($idMaterie, $idStudent, $nota)";
		echo "$sql";
		if ($conn->query($sql) === true){
			echo "<div align = 'center'>Nota adaugata cu succes.</div>";
		} else {
			echo "<div align = 'center'>Campuri nevalide.</div>";
		}
		$conn->close();
	
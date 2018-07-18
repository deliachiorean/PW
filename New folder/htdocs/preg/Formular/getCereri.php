<?php
// Creem o conexiune la baza de date
$connection = mysqli_connect("localhost","root","","produse");

if(!$connection)
	die("Connection failded");

$src=$_GET["src"];

$query="select * from produs where nume like '%".$src."%' or descriere like '%".$src."%'" ;
$result = mysqli_query($connection,$query);
// Declaram un json in care adaugam cererie
$cereri = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			// Daca nu exista email pe sesiune toate elementele sunt afisate "cenzurat"
			
			$cereri[$row['id']] = array(
				'nume' => $row['nume'],
				'descriere' => $row['descriere'],
				'producator' => $row['producator'],
				'pret' => $row['pret'],
				'cantitate' => $row['cantitate'],
				'poza' => $row['poza']
			);
	}
}

echo json_encode($cereri);

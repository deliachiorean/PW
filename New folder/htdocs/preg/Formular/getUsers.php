 <?php
// Creem o conexiune la baza de date
$connection = mysqli_connect("localhost","root","","form");

if(!$connection)
	die("Connection failded");


$query="SELECT * FROM `tbl_login` ORDER by id ASC limit 2";
$result = mysqli_query($connection,$query);
// Declaram un json in care adaugam cererie
$cereri = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			// Daca nu exista email pe sesiune toate elementele sunt afisate "cenzurat"
			
			$cereri[$row['id']] = array(
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name'],
				'gender' => $row['gender'],
				'email' => $row['email'],
				'address' => $row['address'],
				'poza' => $row['poza'],
				'mobile_no' => $row['mobile_no']
			);
	}
}

echo json_encode($cereri);
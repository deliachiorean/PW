<?php
include_once 'config.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");

function responseJSON($data, $status){
	http_response_code($status);
	$response['status'] = $status; 
	$response['data'] = $data;
	$response_json = json_encode($response);
	echo $response_json;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	handleRequest($conn);
}

function handleRequest($conn){
	if (!empty($_GET['id'])){
		$id = mysqli_real_escape_string($conn, $_GET['id']);
	}
	else
		$id = "";
	$data = getMesaj($conn, $id);
	if ($data == null)
		responseJSON($data, 404);
	else {
		
		responseJSON($data,200);
	}
}

function addIstoric($conn, $id) {
	$sql = "UPDATE istoric SET lastId='$id' WHERE id=0";
		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
}

function getMesaj($conn, $id) {
	$sql_command = "SELECT * FROM mesaje WHERE id='$id'";
	return createResult($conn, $sql_command, $id);
}

function createResult($conn, $sql, $id) {
	$results = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($results);

	$data = array();

	if ($count != 1) {
		return null;
	}
	else {
		addIstoric($conn, $id);
		$row = mysqli_fetch_assoc($results);
		return $row;
	}
}
?>
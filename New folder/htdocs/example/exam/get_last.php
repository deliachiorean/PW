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
	$data = getMax($conn);
	if ($data == null)
		responseJSON($data, 404);
	else
		responseJSON($data,200);
}

function getMax($conn) {
	$sql_command = "SELECT lastId FROM istoric where id=0";
	return createResult($conn, $sql_command);
}

function createResult($conn, $sql) {
	$results = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($results);

	$data = array();

	if ($count != 1) {
		return null;
	}
	else {
		$row = mysqli_fetch_assoc($results);
		return $row;
	}
}
?>
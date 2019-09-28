<?php
	// Headers.
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once '../config/Database.php';
	include_once '../models/Generation.php';

	// Instantiate DB and Connect.
	$database = new Database();
	$db = $database->connect();

	// Instantiate generation object.
	$generation = new generation($db);

	// Get raw posted data.
	$data = json_decode(file_get_contents("php://input"));

	if ($generation->generate())
	{
		echo json_encode(
			array(
				'message' => 'Value Generated')
		);
	}
	else
	{
		echo json_encode(
			array(
				'error code:' => http_response_code(),
				'message' => 'Value Not Generated')
		);
	}
?>
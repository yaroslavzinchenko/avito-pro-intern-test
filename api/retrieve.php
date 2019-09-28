<?php
	// Headers.
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	require_once '../config/Database.php';
	require_once '../models/Generation.php';

	// Instantiate DB and Connect.
	$database = new Database();
	$db = $database->connect();

	// Instantiate generation object.
	$generation = new generation($db);

	// Get ID.
	$generation->id = isset($_GET['id']) ? $_GET['id'] : die();

	// Retrieve.
	$generation->retrieve();

	// Create array.
	$generation_arr = array(
		'id' => $generation->id,
		'value' => $generation->value,
		'type' => $generation->type,
		'length' => $generation->length,
		'created_at' => $generation->created_at
	);

	// Make JSON.
	print_r(json_encode($generation_arr));
?>
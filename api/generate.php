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

	$generation->generate();
?>
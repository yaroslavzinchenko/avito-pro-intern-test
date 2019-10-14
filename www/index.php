<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Slim\Factory\AppFactory;

	require __DIR__ . '/vendor/autoload.php';
	require 'src/config/Database.php';

	$app = AppFactory::create();

	$app->get('/', function (Request $request, Response $response, $args) {
    	$response->getBody()->write("Welcome to the avito-pro-intern-test application!");
    	return $response;
	});

	// API controller with routes.
	require 'src/controllers/api.php';

	$app->run();
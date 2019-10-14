<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Slim\Factory\AppFactory;

	// Generate number.

	$app->post('/api/generate/', function (Request $request, Response $response, $args)
	{
    	// Headers.
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Methods: POST');
		header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

		require_once 'src/models/Generation.php';

		// Instantiate DB and Connect.
		$database = new Database();
		$db = $database->connect();

		// Instantiate generation object.
		$generation = new generation($db);

		// Get raw posted data.
		$data = json_decode(file_get_contents("php://input"));

		$generation->type = $data->type;
		$generation->length = $data->length;

		if ($generation->generate())
		{
			echo json_encode(
				array(
					'id' => $generation->id,
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

    	return $response;
	});

	// Get specific generation by id.

	$app->get('/api/retrieve/{id}', function (Request $request, Response $response, $args)
	{
    	// Headers.
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');

		require_once 'src/models/Generation.php';

		// Instantiate DB and Connect.
		$database = new Database();
		$db = $database->connect();

		// Instantiate generation object.
		$generation = new generation($db);

		// $_GET Superglobal.
		// Get ID.
		// $generation->id = isset($_GET['id']) ? $_GET['id'] : die();

		// Symfony.
		$generation->id = isset($args['id']) ? $args['id'] : die();
		// $generation->id = $request->query->get('id') !== null ? $request->query->get('id') : die();

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

    	return $response;
	});
?>
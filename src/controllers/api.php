<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Slim\Factory\AppFactory;

	// Generate number.

	$app->post('/api/generate/', function (Request $request, Response $response, $args)
	{
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

	// Get all generations.
	$app->get('/api/retrieve/all/', function (Request $request, Response $response, $args)
	{
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');

		$sql = 'SELECT * FROM generations';

		try
		{
			$database = new Database();
			$db = $database->connect();

			$stmt = $db->query($sql);

			$generations = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}

		$response->getBody()->write(json_encode($generations));

    	return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
	});

	// Get specific generation by id.

	$app->get('/api/retrieve/{id}', function (Request $request, Response $response, $args)
	{
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');

		require_once 'src/models/Generation.php';

		// Instantiate DB and Connect.
		$database = new Database();
		$db = $database->connect();

		// Instantiate generation object.
		$generation = new generation($db);

		$generation->id = isset($args['id']) ? $args['id'] : die();

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

		$response->getBody()->write(json_encode($generation_arr));

    	return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
	});
?>
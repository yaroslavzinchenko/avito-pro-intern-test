<?php
	class Generation
	{
		// DB stuff.
		private $conn;
		private $table = 'generations';

		// Generation properties.
		public $id;
		public $value;
		public $type;
		public $length;
		public $created_at;

		// Constructor with DB.
		public function __construct($db)
		{
			$this->conn = $db;
		}

		public function generate()
		{
			if ($this->type == 'number')
			{
				require_once('src/includes/consider-length.php');

				$actualNumber = array();
				array_push($actualNumber, 9);
				
				for ($i = 1; $i < $this->length; $i++)
				{
					array_push($actualNumber, 9);
				}

				// Bind data.
				$stmt->bindParam(':value', mt_rand(-implode($actualNumber), implode($actualNumber)));

				// Execute query.
				if ($stmt->execute())
				{
					// Return id.
					require_once('src/includes/return-id.php');

					return true;
				}

				// Print error if something goes wrong.
      			printf("Error: %s.\n", $stmt->error);

				return false;
			}

			// When using alphanumeric type, legth specifies the length in bytes, not the length of the actual string.
			else if ($this->type == 'alphanumeric')
			{
				require_once('src/includes/consider-length.php');

				// Bind data.
				$stmt->bindParam(':value', bin2hex(random_bytes($this->length)));

				// Execute query.
				if ($stmt->execute())
				{
					// Return id.
					require_once('src/includes/return-id.php');

					return true;
				}

				// Print error if something goes wrong.
      			printf("Error: %s.\n", $stmt->error);

				return false;
			}
			else if ($this->type == 'guid')
			{
				require_once('src/includes/not-consider-length.php');

				function getGUID()
				{
    				if (function_exists('com_create_guid'))
   					{
 						return com_create_guid();
    				}
    				else
    				{
						mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
        				$charid = strtoupper(md5(uniqid(rand(), true)));
        				$hyphen = chr(45);// "-"
        				$uuid = chr(123)// "{"
            				.substr($charid, 0, 8).$hyphen
            				.substr($charid, 8, 4).$hyphen
            				.substr($charid,12, 4).$hyphen
            				.substr($charid,16, 4).$hyphen
            				.substr($charid,20,12)
            				.chr(125);// "}"
        				return $uuid;
    				}
				}

				$myGUID = getGUID();

				// Bind data.
				$stmt->bindParam(':value', $myGUID);

				// Execute query.
				if ($stmt->execute())
				{
					require_once('src/includes/return-id.php');

					return true;
				}

				// Print error if something goes wrong.
      			printf("Error: %s.\n", $stmt->error);

				return false;
			}
			else if ($this->type == 'string')
			{
				require_once('src/includes/consider-length.php');

				function generateRandomString($length)
				{
    				$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    				$charactersLength = strlen($characters);
    				$randomString = '';
    				for ($i = 0; $i < $length; $i++)
    				{
        				$randomString .= $characters[rand(0, $charactersLength - 1)];
    				}
    				return $randomString;
				}

				// Bind data.
				$stmt->bindParam(':value', generateRandomString($this->length));

				// Execute query.
				if ($stmt->execute())
				{
					// Return id.
					require_once('src/includes/return-id.php');

					return true;
				}

				// Print error if something goes wrong.
      			printf("Error: %s.\n", $stmt->error);

				return false;
			}
			else if ($this->type == 'custom')
			{
				require_once('src/includes/consider-length.php');

				function generateRandomString($length)
				{
					// Custom characters.
    				$characters = '!<1Js93LdsdAS83';
    				$charactersLength = strlen($characters);
    				$randomString = '';
    				for ($i = 0; $i < $length; $i++)
    				{
        				$randomString .= $characters[rand(0, $charactersLength - 1)];
    				}
    				return $randomString;
				}

				// Bind data.
				$stmt->bindParam(':value', generateRandomString($this->length));

				// Execute query.
				if ($stmt->execute())
				{
					// Return id.
					require_once('src/includes/return-id.php');

					return true;
				}

				// Print error if something goes wrong.
      			printf("Error: %s.\n", $stmt->error);

				return false;
			}
		}

		// Get generated value by its id.
		public function retrieve()
		{
			$query = 'SELECT g.id, g.value, g.type, g.length, g.created_at
						FROM ' . $this->table . ' g 
						WHERE g.id = ?
						LIMIT 0,1';

			// Prepare statement.
			$stmt = $this->conn->prepare($query);

			// Bind ID.
			$stmt->bindParam(1, $this->id);

			// Execute Query.
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// Set properties.
			$this->id = $row['id'];
			$this->value = $row['value'];
			$this->type = $row['type'];
			$this->length = $row['length'];
			$this->created_at = $row['created_at'];
		}
	}
?>
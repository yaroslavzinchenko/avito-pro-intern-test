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
			$query = 'INSERT INTO ' . $this->table . ' SET value = :value,
					type = :type,
					length = :length;';

			// Prepare statement.
			$stmt = $this->conn->prepare($query);

			// Clean data.
			$this->value = htmlspecialchars(strip_tags($this->value));
			$this->type = htmlspecialchars(strip_tags($this->type));
			$this->length = htmlspecialchars(strip_tags($this->length));

			// Bind data.
			$stmt->bindParam(':type', $this->type);

			if ($this->length <= 0)
			{
				return false;
			}
			
			$stmt->bindParam(':length', $this->length);

			if ($this->type == 'number')
			{
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
					$returnQuery = 'SELECT id FROM ' . $this->table . ' ORDER BY id DESC LIMIT 1;';
					$returnStmt = $this->conn->prepare($returnQuery);
					$returnStmt->execute();
					$row = $returnStmt->fetch(PDO::FETCH_ASSOC);
					$this->id = $row['id'];

					return true;
				}

				// Print error if something goes wrong.
      			printf("Error: %s.\n", $stmt->error);

				return false;
			}

			// When using alphanumeric type, legth specifies the length in bytes, not the length of the actual string.
			else if ($this->type == 'alphanumeric')
			{
				// Bind data.
				$stmt->bindParam(':value', bin2hex(random_bytes($this->length)));
				

				// Execute query.
				if ($stmt->execute())
				{
					// Return id.
					$returnQuery = 'SELECT id FROM user ORDER BY id DESC LIMIT 1;';
					$returnStmt = $this->conn->prepare($returnQuery);
					$returnStmt->execute();
					$row = $returnStmt->fetch(PDO::FETCH_ASSOC);
					$this->id = $row['id'];

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
			$query = 'SELECT g.id, g.value, g.created_at
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
			$this->created_at = $row['created_at'];
		}
	}
?>
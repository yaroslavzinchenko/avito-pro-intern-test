<?php
	class Generation
	{
		// DB stuff.
		private $conn;
		private $table = 'generations';

		// Generation properties.
		public $id;
		public $value;
		public $length;
		public $created_at;

		// Constructor with DB.
		public function __construct($db)
		{
			$this->conn = $db;
		}

		public function generate($type)
		{
			$query = 'INSERT INTO ' . $this->table . ' SET value = :value';

			// Prepare statement.
			$stmt = $this->conn->prepare($query);

			// Clean data.
			$this->value = htmlspecialchars(strip_tags($this->value));

			if ($type == 'number')
			{
				// Bind data.
				$stmt->bindParam(':value', mt_rand());
			}

			// Execute query.
			if ($stmt->execute())
			{
				return true;
			}

			// Print error if something goes wrong.
      		printf("Error: %s.\n", $stmt->error);

			return false;
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
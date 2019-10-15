<?php
	class Database
	{
		// Database parameters.

		// For Docker.
		// private $host = 'db';

		// For local development (I use Open Server).
		private $host = 'localhost';

		private $db_name = 'avito-pro-intern-test';
		private $username = 'root';
		private $password = 'password';
		private $conn;

		// Database connect.
		public function connect()
		{
			$this->conn = null;

			try
			{
				$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $e)
			{
				echo 'Connection Error: ' . $e->getMessage();
			}

			return $this->conn;
		}
	}
?>
<?php
	$query = 'INSERT INTO ' . $this->table . ' SET value = :value,
					type = :type;';

	// Prepare statement.
	$stmt = $this->conn->prepare($query);

	// Clean data.
	$this->value = htmlspecialchars(strip_tags($this->value));
	$this->type = htmlspecialchars(strip_tags($this->type));

	// Bind data.
	$stmt->bindParam(':type', $this->type);
?>
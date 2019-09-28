<?php
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
?>
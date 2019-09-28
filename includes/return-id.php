<?php
	// Return id.
	$returnQuery = 'SELECT id FROM ' . $this->table . ' ORDER BY id DESC LIMIT 1;';
	$returnStmt = $this->conn->prepare($returnQuery);
	$returnStmt->execute();
	$row = $returnStmt->fetch(PDO::FETCH_ASSOC);
	$this->id = $row['id'];
?>
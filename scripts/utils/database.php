<?php
	$conn = new mysqli("localhost", "clara", "clara", "clara");
	if($conn->connect_error) {
		$response["success"] = false;
		$response["message"] = "Connection failed: " . $conn->connect_error;
	} 
?>

<?php
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	if(strcmp($username, "claraho") == 0 && strcmp($password, "password") == 0) {
		$response["success"] = true;
	}
	else {
		$response["success"] = false;
		$response["message"] = "Invalid username or password";
	}
	
	echo(json_encode($response));
?>

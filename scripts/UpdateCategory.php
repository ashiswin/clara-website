<?php
	require_once 'utils/database.php';
	require_once 'connectors/CategoryConnector.php';
	
	$id = $_POST['id'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	
	$CategoryConnector = new CategoryConnector($conn);
	
	$CategoryConnector->update($id, $category, $description);
	$response["success"] = true;
	
	echo(json_encode($response));
?>

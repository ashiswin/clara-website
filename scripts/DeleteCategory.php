<?php
	require_once 'utils/database.php';
	require_once 'connectors/CategoryConnector.php';
	
	$id = $_POST['id'];
	
	$CategoryConnector = new CategoryConnector($conn);
	$CategoryConnector->delete($id);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

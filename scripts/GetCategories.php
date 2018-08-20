<?php
	require_once 'utils/database.php';
	require_once 'connectors/CategoryConnector.php';
	
	$CategoryConnector = new CategoryConnector($conn);
	
	$response["categories"] = $CategoryConnector->selectAll();
	$response["success"] = true;
	
	echo(json_encode($response));
?>

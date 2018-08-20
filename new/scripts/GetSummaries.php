<?php
	require_once 'utils/database.php';
	require_once 'connectors/SummaryConnector.php';
	
	$SummaryConnector = new SummaryConnector($conn);
	
	$response["summaries"] = $SummaryConnector->selectAll();
	$response["success"] = true;
	
	echo(json_encode($response));
?>

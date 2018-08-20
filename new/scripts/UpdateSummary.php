<?php
	require_once 'utils/database.php';
	require_once 'connectors/SummaryConnector.php';
	
	$id = $_POST['id'];
	$summary = $_POST['summary'];
	
	$SummaryConnector = new SummaryConnector($conn);
	
	$SummaryConnector->update($id, $summary);
	$response["success"] = true;
	
	echo(json_encode($response));
?>

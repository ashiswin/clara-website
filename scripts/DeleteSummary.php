<?php
	require_once 'utils/database.php';
	require_once 'connectors/SummaryConnector.php';
	
	$id = $_POST['id'];
	
	$SummaryConnector = new SummaryConnector($conn);
	$summary = $SummaryConnector->select($id);
	
	unlink("../" . $summary[SummaryConnector::COLUMN_IMAGE]);
	$SummaryConnector->delete($id);
	$response["success"] = true;
	
	echo(json_encode($response));
?>

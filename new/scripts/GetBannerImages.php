<?php
	require_once 'utils/database.php';
	require_once 'connectors/BannerConnector.php';
	
	$BannerConnector = new BannerConnector($conn);
	
	$response["images"] = $BannerConnector->selectAll();
	$response["success"] = true;
	
	echo(json_encode($response));
?>

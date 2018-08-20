<?php
	require_once 'utils/database.php';
	require_once 'connectors/BannerConnector.php';
	
	$image = $_POST['image'];
	
	$BannerConnector = new BannerConnector($conn);
	
	$BannerConnector->delete($image);
	$response["success"] = true;
	
	echo(json_encode($response));
?>

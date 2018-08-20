<?php
	require_once 'utils/database.php';
	require_once 'connectors/ImageConnector.php';
	
	$id = intval($_GET['id']);
	
	$ImageConnector = new ImageConnector($conn);
	$response["images"] = $ImageConnector->selectByAlbum($id);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

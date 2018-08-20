<?php
	require_once 'utils/database.php';
	require_once 'connectors/ImageConnector.php';
	
	$image = $_POST['image'];
	
	$ImageConnector = new ImageConnector($conn);
	$imageLink = $ImageConnector->select($image)[ImageConnector::$COLUMN_IMAGE];
	unlink("../" . $imageLink);
	
	$ImageConnector->delete($image);
	$response["success"] = true;
	
	echo(json_encode($response));
?>

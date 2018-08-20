<?php
	require_once 'utils/database.php';
	require_once 'connectors/ImageConnector.php';
	
	$image1 = $_POST['image1'];
	$image2 = $_POST['image2'];
	
	$ImageConnector = new ImageConnector($conn);
	$ImageConnector->setId($image1, 0);
	$ImageConnector->setId($image2, $image1);
	$ImageConnector->setId(0, $image2);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

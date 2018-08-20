<?php
	require_once 'utils/database.php';
	require_once 'connectors/AlbumConnector.php';
	require_once 'connectors/ImageConnector.php';
	
	$id = $_POST['id'];
	
	$AlbumConnector = new AlbumConnector($conn);
	$ImageConnector = new ImageConnector($conn);
	
	$AlbumConnector->delete($id);
	
	$images = $ImageConnector->selectByAlbum($id);
	
	for($i = 0; $i < count($images); $i++) {
		unlink("../" . $images[$i][ImageConnector::$COLUMN_IMAGE]);
	}
	$ImageConnector->deleteByAlbum($id);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

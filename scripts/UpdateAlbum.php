<?php
	require_once 'utils/database.php';
	require_once 'connectors/AlbumConnector.php';
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$category = $_POST['category'];
	
	$AlbumConnector = new AlbumConnector($conn);
	
	$AlbumConnector->update($id, $name, $description, $category);
	$response["success"] = true;
	
	echo(json_encode($response));
?>

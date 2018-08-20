<?php
	if(!isset($_FILES['coverImage'])) return;
	require_once 'utils/database.php';
	require_once 'connectors/AlbumConnector.php';
	
	$name = $_POST['name'];
	$description = nl2br($_POST['description']);
	$category = $_POST['category'];
	
	$targetDir = "../img/uploads/";
	$filename = uniqid('album-', true);
	
	$targetFile = $targetDir . $filename;
	move_uploaded_file($_FILES["coverImage"]["tmp_name"], $targetFile);
	
	$cover = "img/uploads/" . $filename;
	
	$AlbumConnector = new AlbumConnector($conn);
	$AlbumConnector->create($name, $description, $category, $cover);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

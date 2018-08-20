<?php
	require_once 'utils/database.php';
	require_once 'connectors/CategoryConnector.php';
	
	$category = $_POST['category'];
	$description = nl2br($_POST['description']);
	
	$targetDir = "../img/uploads/";
	$filename = uniqid('category-', true);
	
	$targetFile = $targetDir . $filename;
	move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile);
	
	$image = "img/uploads/" . $filename;
	
	$CategoryConnector = new CategoryConnector($conn);
	$CategoryConnector->create($image, $category, $description);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

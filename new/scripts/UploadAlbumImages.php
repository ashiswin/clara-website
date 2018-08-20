<?php
	require_once 'utils/database.php';
	require_once 'connectors/ImageConnector.php';
	
	if(!isset($_FILES['albumImages'])) return;
	
	$album = $_POST['album'];
	$ImageConnector = new ImageConnector($conn);
	
	$count = count($_FILES['albumImages']['name']);
	$targetDir = "../img/uploads/";
	for ($i = 0; $i < $count; $i++) {
		$filename = uniqid('image-', true);
		$targetFile = $targetDir . $filename;
		move_uploaded_file($_FILES["albumImages"]["tmp_name"][$i], $targetFile);
		$location = "img/uploads/" . $filename;
		list($width, $height, $type, $attr) = getimagesize($targetFile);
		
		if($width < $height) {
			$ImageConnector->create($location, $album, 0);
		}
		else {
			$ImageConnector->create($location, $album, 1);
		}
	}
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

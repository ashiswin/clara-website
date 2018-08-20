<?php
	require_once 'utils/database.php';
	require_once 'connectors/BannerConnector.php';
	
	if(!isset($_FILES['bannerImages'])) return;
	
	$BannerConnector = new BannerConnector($conn);
	
	$count = count($_FILES['bannerImages']['name']);
	$targetDir = "../img/uploads/";
	for ($i = 0; $i < $count; $i++) {
		$filename = uniqid('banner-', true);
		$targetFile = $targetDir . $filename;
		move_uploaded_file($_FILES["bannerImages"]["tmp_name"][$i], $targetFile);
		$location = "img/uploads/" . $filename;
		
		$BannerConnector->create($location);
	}
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

<?php
	if(!isset($_FILES['summaryImage'])) return;
	require_once 'utils/database.php';
	require_once 'connectors/SummaryConnector.php';
	
	$summary = nl2br($_POST['summary']);
	
	$targetDir = "../img/uploads/";
	$filename = uniqid('summary-', true);
	
	$targetFile = $targetDir . $filename;
	move_uploaded_file($_FILES["summaryImage"]["tmp_name"], $targetFile);
	
	$image = "img/uploads/" . $filename;
	
	$SummaryConnector = new SummaryConnector($conn);
	$SummaryConnector->create($image, $summary);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

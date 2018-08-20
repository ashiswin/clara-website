<?php
	require_once 'utils/database.php';
	require_once 'connectors/AlbumConnector.php';
	require_once 'connectors/CategoryConnector.php';
	
	$AlbumConnector = new AlbumConnector($conn);
	$CategoryConnector = new CategoryConnector($conn);
	
	$response["albums"] = $AlbumConnector->selectAll();
	
	for($i = 0; $i < count($response["albums"]); $i++) {
		$response["albums"][$i]["categoryName"] = $CategoryConnector->select($response["albums"][$i]["category"])[CategoryConnector::$COLUMN_CATEGORY];
	}
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

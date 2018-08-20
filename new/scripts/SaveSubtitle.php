<?php
	$subtitle = fopen("../config/bannerSubtitle.txt", "w");
	
	fwrite($subtitle, $_POST['subtitle']);
	fclose($subtitle);
	
	$response["success"] = true;
	
	echo(json_encode($response));
?>

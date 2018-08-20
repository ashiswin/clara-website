<!DOCTYPE html>
<html>
<head>
	<title>Clara Ho - Portfolio</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="css/common.css">
</head>
<body>
	<?php require_once "nav.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="offset-md-3 col-md-3 cat-title">
				<i style="text-align: center; vertical-align: middle; font-family: 'Stalemate', Arial, sans-serif; font-size: 7em;">Weddings</i>
			</div>
			<a href="weddings.html" class="thumbnail col-md-3" data-content="Weddings">
				<img src="img/three.jpg">
			</a>
		</div>
		<div class="row">
			<a href="events.html" class="thumbnail offset-md-3  col-md-3" data-content="Events">
				<img src="img/seven.jpg" class="portrait">
			</a>
			<div class="col-md-3 cat-title">
				<i style="text-align: center; vertical-align: middle; font-family: 'Stalemate', Arial, sans-serif; font-size: 7em;">Events</i>
			</div>
		</div>
		<div class="row">
			<div class="offset-md-3 col-md-3 cat-title">
				<i style="text-align: center; vertical-align: middle; font-family: 'Stalemate', Arial, sans-serif; font-size: 7em;">Portraits</i>
			</div>
			<a href="portraits.html" class="thumbnail col-md-3" data-content="Portraits">
				<img src="img/five.jpg" class="portrait">
			</a>
		</div>
	</div>
	<div style="text-align: center; vertical-align: middle; line-height: 5vh; width: 100%; height: 5vh; font-size: 8px;">
		&copy; 2017 Clara Ho Photography
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".thumbnail").css('width', $(".container-fluid").width() / 4);
			$(".thumbnail").css('height', $(".container-fluid").width() / 4);
			$(".cat-title").css('line-height', ($(".container-fluid").width() / 4) + "px");
			$(".cat-title").css('height', $(".container-fluid").width() / 4);
		});
	</script>
</body>
</html>

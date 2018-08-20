<!DOCTYPE html>
<html>
<head>
	<title>Clara Ho Photography</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		@font-face {
			font-family: "Raleway";
			src: url("../fonts/Raleway-Light.ttf") format("opentype");
		}
		@font-face {
			font-family: "Stalemate";
			src: url("../fonts/Stalemate-Regular.ttf") format("opentype");
		}
		@font-face {
			font-family: "Plantin";
			src: url("../fonts/Plantin-Light.otf") format("opentype");
		}
		@font-face {
			font-family: "Midnight";
			src: url("../fonts/Midnight.otf") format("opentype");
		}
		@font-face {
			font-family: "JosefinSans";
			src: url("../fonts/JosefinSans-Regular.ttf") format("opentype");
		}
		@font-face {
			font-family: "Oxygen";
			src: url("../fonts/Oxygen.otf") format("opentype");
		}
		.spinning {
			animation: spin 1s infinite linear;
			-webkit-animation: spin2 1s infinite linear;
		}
		@keyframes spin {
			from { transform: scale(1) rotate(0deg); }
			to { transform: scale(1) rotate(360deg); }
		}
		@-webkit-keyframes spin2 {
			from { -webkit-transform: rotate(0deg); }
			to { -webkit-transform: rotate(360deg); }
		}
		html, body {
			margin: 0;
			height: 100%;
			overflow: hidden
		}
		.scrollable {
			overflow-y: auto !important;
			overflow-x: auto;
			height: 90vh;
		}
		
		.box {
			position: relative;
			display: inline-block;
			z-index: 2;
			transition: all 0.3s ease-in-out;
		}

		.box:hover {
			box-shadow: 0 5px 15px rgba(0,0,0,0.3);
			background-color: #333;
			border-radius: 5px;
		}
		
		.pressed, .box:active {
			box-shadow: inset 0 5px 15px rgba(0,0,0,0.3);
			background-color: #333;
			border-radius: 5px;
		}
		.thumbnail {
			position: relative;
			overflow: hidden;
		}
		.thumbnail .thumbnail-image {
			position: absolute;
			left: 50%;
			top: 50%;
			height: 100%;
			width: auto;
			-webkit-transform: translate(-50%,-50%);
			-ms-transform: translate(-50%,-50%);
			transform: translate(-50%,-50%);
		}
		.thumbnail .thumbnail-image.portrait {
			width: 100%;
			height: auto;
		}
		.inverted {
			-webkit-filter: invert(100%); /* Safari 6.0 - 9.0 */
			filter: invert(100%);
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-toggleable-md navbar-light bg-inverse">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="/" style="font-family: 'Stalemate', Arial, sans-serif; font-size: 2em; font-weight: bold; margin-bottom: -2vh; margin-top: -2vh; padding-top: 15px; color: white;">Clara Ho</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li id="navHome" class="nav-item"><a href="logout.php" class="nav-link" style="font-size: 1em; color: white">Logout</a></li>
			</ul>
		</div>
	</nav>
	<div class="row" style="height: 100%">
		<div class="col-md-2 bg-inverse text-white scrollable" id="sidebar" style="height: 100%; padding-top: 1vh;">
			<a href="#" style="text-decoration: none; color: white; width: 100%; padding: 1vh; margin-left: 1vh;" class="box pressed" target="#homePane">Home</a>
			<a href="#" style="text-decoration: none; color: white; width: 100%; padding: 1vh; margin-left: 1vh;" class="box" target="#portfolioPane">Portfolio</a>
			<a href="#" style="text-decoration: none; color: white; width: 100%; padding: 1vh; margin-left: 1vh;" class="box" target="#aboutPane">About</a>
			<a href="#" style="text-decoration: none; color: white; width: 100%; padding: 1vh; margin-left: 1vh;" class="box" target="#contactPane">Contact</a>
		</div>
		<div class="col-md-10 scrollable" style="100%; padding-top: 1vh">
			<?php require_once 'homePane.php'; ?>
			<?php require_once 'portfolioPane.php'; ?>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script src="homePane.js"></script>
	<script src="portfolioPane.js"></script>
	<script type="text/javascript">
		var summaryImage = 0;
		var summaryImageMax = 10;
		
		$(document).ready(function() {
			$('.pane').hide();
			$('#homePane').show();
			
			$('.box').click(function(e) {
				e.preventDefault();
				
				$('.box').removeClass('pressed');
				$(this).addClass('pressed');
				
				$('.pane').hide();
				$($(this).attr('target')).show();
			});
		});
	</script>
</body>
</html>

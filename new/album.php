<?php
	if(!isset($_GET['id'])) {
		header("Location: /");
	}
	
	require_once 'scripts/utils/database.php';
	require_once 'scripts/connectors/AlbumConnector.php';
	require_once 'scripts/connectors/ImageConnector.php';
	
	$alb = intval($_GET['id']);
	$AlbumConnector = new AlbumConnector($conn);
	
	$album = $AlbumConnector->select($alb);

	$events = $AlbumConnector->selectByCategory(8);
	$weddings = $AlbumConnector->selectByCategory(7);
	$portraits = $AlbumConnector->selectByCategory(9);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $album[AlbumConnector::$COLUMN_NAME]; ?> - Clara Ho Photography</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link rel="stylesheet" href="fonts/fonts.css">
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" type="text/css" href="album.css">
	<link rel="stylesheet" href="css/ekko-lightbox.css">
	<style>
		#overlay {
			position: fixed; /* Sit on top of the page content */
			display: none; /* Hidden by default */
			width: 100%; /* Full width (cover the whole page) */
			height: 100%; /* Full height (cover the whole page) */
			top: 0; 
			left: 0;
			right: 0;
			bottom: 0;
			background-color: white; /* Black background with opacity */
			z-index: 200; /* Specify a stack order in case you're using a different order for other elements */
			cursor: pointer; /* Add a pointer on hover */
		}
		a img {
			opacity: 0;
		}
	</style>
</head>
<body>
	<div class="container container-small">
		<div class="row">
			<span class="title">CLARA HO PHOTOGRAPHY</span>
			<span class="subtitle"><?php echo file('config/bannerSubtitle.txt')[0]; ?></span>
		</div>
		<nav class="navbar navbar-expand-sm navbar-light bg-clear flex-nowrap" style="margin-top: 2vh">
			<button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbar5">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse w-100 justify-content-center">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link text-white" href="/new">HOME</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				        	COUPLES
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				        	<?php
				        		foreach($weddings as $w) {
				        			echo "<a class=\"dropdown-item\" href=\"album.php?id=" . $w[AlbumConnector::$COLUMN_ID]. "\">" . $w[AlbumConnector::$COLUMN_NAME] . "</a>";
				        		}
				        	?>
				        </div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				        	EVENTS
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				        	<?php
				        		foreach($events as $e) {
				        			echo "<a class=\"dropdown-item\" href=\"album.php?id=" . $e[AlbumConnector::$COLUMN_ID]. "\">" . $e[AlbumConnector::$COLUMN_NAME] . "</a>";
				        		}
				        	?>
				        </div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				        	PORTRAITS
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				        	<?php
				        		foreach($portraits as $p) {
				        			echo "<a class=\"dropdown-item\" href=\"album.php?id=" . $p[AlbumConnector::$COLUMN_ID]. "\">" . $p[AlbumConnector::$COLUMN_NAME] . "</a>";
				        		}
				        	?>
				        </div>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#">ABOUT US</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="https://www.instagram.com/hpyclara/">INSTAGRAM</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	
	<div class="container container-small">
		<div class="row">
			<span class="album-title"><?php echo strtoupper($album[AlbumConnector::$COLUMN_NAME]); ?> </span>
			<span class="album-description"><?php echo $album[AlbumConnector::$COLUMN_DESCRIPTION]; ?> </span>
		</div>
	</div>

	<div id="images" class="container container-small" width="100%" style="color: #666666; margin-top: 4vh;">
	</div>
	
	<div class="container container-small" style="margin-top: 15vh; margin-bottom: 5vh">
		<footer>
			Clara Ho Photography | Singapore Wedding Photographer | Best Singapore Wedding Photographer | Top Singapore Wedding Photographer
		</footer>
	</div>
	
	<div class="modal" id="mdlLightbox">
		<div class="modal-lg modal-dialog" role="document" style="max-width: 80% !important">
			<div class="modal-content" style="height: auto; min-height: 100%; border-radius: 0">
				<div class="modal-body">
					<img id="imgLightbox" width="100%">
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var summaryImage = 0;
		var summaryImageMax = 10;
		var imagePositions = new Array();
		$(document).ready(function() {
			$(".carousel-item").css('width', $(window).width());
			$(".fill-screen").css('height', $(window).height() / 2);
			$(".thumbnail").css('height', $(".thumbnail").width());

			$('#scrollDown').click(function(e) {
				e.preventDefault();
				$("#albums").animate({ opacity: 1 }, { queue: false, duration: 'slow' });
				$('html, body').animate({ scrollTop: $(window).height()}, $(window).height(), 'swing');
				$(".fill-screen").css('height', $(window).height());
			});
			$("body").on("contextmenu",function(e){
				return false;
			});
			$('body').bind('cut copy paste', function (e) {
				e.preventDefault();
			});
		});
		$(window).resize(function() {
			$(".carousel-item").css('width', $(window).width());
			$(".fill-screen").css('height', $(window).height() / 2);
			$(".thumbnail").css('height', $(".thumbnail").width());
		});
		$.get('scripts/GetAlbumImages.php?id=<?php echo $alb; ?>', function(data) {
			var response = JSON.parse(data);
			if(response.success) {
				var html = "";
				for(var i = 0; i < response.images.length; i++) {
					html += "<div class=\"row\">\n";
					html += "\t<div class=\"col-md-12\">\n";
					html += "\t\t<a class=\"lightbox\" href=\"" + response.images[i].image + "\">\n";
					html += "\t\t\t<img src=\"" + response.images[i].image + "\" style=\"margin: 0.25vh auto; width: 100%\">\n";
					html += "\t\t</a>\n";
					html += "\t</div>\n";
					html += "</div>\n";
				}
				$("#images").html(html);
				$("a > img").each(function() {
					var scrollPos = $(document).scrollTop();
					if(scrollPos > $(this).offset().top - $(window).height()) {
						$(this).animate({ opacity: 1 }, { queue: false, duration: 'fast' });
					}
					else {
						imagePositions.push($(this));
					}
				});
				
				$(window).scroll(function() {
					var scrollPos = $(document).scrollTop();
					for(var i = 0; i < imagePositions.length; i++) {
						if(scrollPos > imagePositions[i].offset().top - $(window).height()) {
							imagePositions[i].animate({ opacity: 1 }, { queue: false, duration: 'slow' });
						}
					}
				});
				
				$(".lightbox").click(function(e) {
					e.preventDefault();
					
					$("#mdlLightbox").modal();
					$("#imgLightbox").attr('src', $(this).attr('href'));
				});
			}
		});
		function on() {
			document.getElementById("overlay").style.display = "block";
		}

		function off() {
			document.getElementById("overlay").style.display = "none";
		}
		
		$(".thumbnail").click(function(e) {
			e.preventDefault();
			on();
		});
		$("#closeModal").click(function(e) {
			e.preventDefault();
			off();
		});
	</script>
</body>
</html>

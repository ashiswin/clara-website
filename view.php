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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Clara Ho - <?php echo $album[AlbumConnector::$COLUMN_NAME]; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/common.css">
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
	<?php require_once "nav.php"; ?>
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" width="100%">
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item fill-screen active">
				<img class="d-block img-fluid" src="<?php echo $album[AlbumConnector::$COLUMN_COVER]; ?>" alt="Main Image">
			</div>
		</div>
	</div>
	<div style="text-align: center; position: relative; top: -35vh; z-index: 99; color: white; height: 0">
		<h1 style="font-family: 'Stalemate', Arial, sans-serif; font-size: 11em; font-weight: bold"><?php echo $album[AlbumConnector::$COLUMN_NAME]; ?></h1>
		
	</div>
	<div class="container">
		<p style="font-family: 'Raleway', Arial, sans-serif; font-size: 1em; text-align: center; margin-top: 2vh;	">
			<?php echo $album[AlbumConnector::$COLUMN_DESCRIPTION]; ?> 
		</p>
		<hr>
	</div>
	<div id="images" class="container" width="100%" style="color: #666666">
	</div>
	<div class="container">
		<hr>
	</div>
	<div style="text-align: center; vertical-align: middle; line-height: 5vh; width: 100%; height: 5vh; font-size: 8px; ">
		&copy; 2017 Clara Ho Photography
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
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
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
				var portraitImages = new Array();
				var landscapeImages = new Array();
				for(var i = 0; i < response.images.length; i++) {
					if(response.images[i].landscape == 0) {
						portraitImages.push(response.images[i]);
					}
					else {
						landscapeImages.push(response.images[i]);
					}
				}
				
				if(portraitImages.length % 2 == 1) {
					portraitImages.splice(portraitImages.length - 1, 1);
				}
				var landscapeCount = 0;
				var portraitCount = 0;
				
				html = "";
				for(var i = 0; i < response.images.length; i++) {
					if((i % 3 == 0 || i % 3 == 2) && landscapeCount < landscapeImages.length) {
						html += "<div class=\"row\">\n";
						html += "\t<div class=\"col-md-12\">\n";
						html += "\t\t<a class=\"lightbox\" href=\"" + landscapeImages[landscapeCount].image + "\">\n";
						html += "\t\t\t<img src=\"" + landscapeImages[landscapeCount].image + "\" width=\"100%\">\n";
						html += "\t\t</a>\n";
						html += "\t</div>\n";
						html += "</div>\n";
						html += "<br>\n";
						landscapeCount++;
					}
					else if(portraitCount < portraitImages.length) {
						html += "<div class=\"row\">\n";
						html += "\t<div class=\"col-md-6\">\n";
						html += "\t\t<a class=\"lightbox\" href=\"" + portraitImages[portraitCount].image + "\">\n";
						html += "\t\t\t<img src=\"" + portraitImages[portraitCount].image + "\" width=\"100%\">\n";
						html += "\t\t</a>\n";
						html += "\t</div>\n";
						html += "\t<div class=\"col-md-6\">\n";
						html += "\t\t<a class=\"lightbox\" href=\"" + portraitImages[portraitCount + 1].image + "\">\n";
						html += "\t\t\t<img src=\"" + portraitImages[portraitCount + 1].image + "\" width=\"100%\">\n";
						html += "\t\t</a>\n";
						html += "\t</div>\n";
						html += "</div>\n";
						html += "<br>\n";
						portraitCount += 2;
					}
				}
				$("#images").html(html);
				$("a > img").each(function() {
					var scrollPos = $(document).scrollTop();
					if(scrollPos > $(this).offset().top - $(window).height()) {
						$(this).animate({ opacity: 1 }, { queue: false, duration: 'slow' });
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

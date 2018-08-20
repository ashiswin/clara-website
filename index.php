<?php
	require_once 'scripts/utils/database.php';
	require_once 'scripts/connectors/BannerConnector.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Clara Ho Photography</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/common.css">
	
	<style>
		.thumbnail {			
			border-top: 4vh solid #fff;
			border-bottom: 4vh solid #fff;
			border-left: 2vh solid #fff;
			border-right: 2vh solid #fff;
		}
	</style>
</head>
<body>
	<?php require_once "nav.php"; ?>
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" width="100%">
		<div class="carousel-inner" role="listbox">
			<?php
				$BannerConnector = new BannerConnector($conn);
				$images = $BannerConnector->selectAll();
				
				for($i = 0; $i < count($images); $i++) {
					if($i == 0) {
						echo "<div class=\"carousel-item fill-screen active\">";
					}
					else {
						echo "<div class=\"carousel-item fill-screen\">";
					}
					echo "<img class=\"d-block img-fluid\" src=\"" . $images[$i][BannerConnector::$COLUMN_IMAGE] . "\">";
					echo "</div>";
				}
			?>
		</div>
	</div>
	<div style="text-align: center; vertical-align: middle; line-height: 5vh; width: 100%; height: 5vh; position: relative; top: -20vh; z-index: 99; font-size: 20px">
		<p id="section05">
			<a id="scrollDown" href="#">Scroll down for more<span></span></a>
		</p>
	</div>
	<div style="text-align: center; position: relative; top: -75vh; z-index: 99; color: white; height: 0">
		<h1 style="font-family: 'Stalemate', Arial, sans-serif; font-size: 11em; font-weight: bold">Clara Ho</h1>
		<p style="font-family: 'Stalemate', Arial, sans-serif; font-size: 3em; position: absolute; top: 20vh; width: 100%">
			<?php echo file('config/bannerSubtitle.txt')[0]; ?>
		</p>
	</div>
	<div id="summaries" class="container-fluid" width="100%" style="opacity: 0; color: #666666">
		<h1 style="font-family: 'Raleway', Arial, sans-serif; font-size: 4em; font-weight: bold;">Some Title</h1>
		<div class="row" width="100%">
			<div class="col-md-6" id="storiesOfLifeContainer">
				<br>
				<br>
				<p style="font-size: 1.2em" id="summaryText">
				</p>
			</div>
			<div class="col-md-6">
				<img id="summaryImage" src="img/two.jpg" width="100%" style="object-fit: contain;">
			</div>
		</div>
		<div style="text-align: center; margin-top: 5vh; width: 100%; font-size: 1.5em">
			 <a href="#" id="btnSummaryLeft"><span class="left"></span></a>&nbsp;<span id="summaryImageNumber"></span> / <span id="summaryImageMax"></span>&nbsp;<a href="#" id="btnSummaryRight"><span class="right"></span></a>
		</div>
	</div>
	<div class="container">
		<hr>
	</div>
	<div class="container-fluid" width="100%" style="color: #666666">
		<h1 id="featuredAlbumsTitle" style="font-family: 'Raleway', Arial, sans-serif; font-size: 4em; font-weight: bold; margin-top: 5vh;">Featured Albums</h1>
		<div class="row" id="featuredAlbums">
			<a href="view.php?alb=1" class="thumbnail col-md-4" data-content="Wedding 1">
				<img class="portrait" src="img/one.jpg">
			</a>
			<a href="#" class="thumbnail col-md-4" data-content="Event 2">
				<img src="img/two.jpg">
			</a>
			<a href="#" class="thumbnail col-md-4" data-content="Portrait 3">
				<img src="img/three.jpg">
			</a>
		</div>
	</div>
	<div style="text-align: center; vertical-align: middle; line-height: 5vh; width: 100%; height: 5vh; font-size: 8px; ">
		&copy; 2017 Clara Ho Photography
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var summaryImage = 0;
		var summaryImageMax = 10;
		
		$(document).ready(function() {
			$(".carousel-item").css('width', $(window).width());
			$(".fill-screen").css('height', $(window).height());
			$(".thumbnail").css('height', $(".thumbnail").width());

			$("#summaries").css('height', $(window).height());

			$("#featuredAlbums > a").fadeOut();
			$("#featuredAlbumsTitle").fadeOut();

			$('#scrollDown').click(function(e) {
				e.preventDefault();
				$("#summaries").animate({ opacity: 1 }, { queue: false, duration: 'slow' });
				$('html, body').animate({ scrollTop: $(window).height()}, $(window).height(), 'swing');
				$(".fill-screen").css('height', $(window).height());
			});
		});
		$(window).scroll(function() {
			var scrollPos = $(document).scrollTop();
			if(scrollPos > 0) {
				$("#summaries").animate({ opacity: 1 }, { queue: false, duration: 'slow' });
			}
			if(scrollPos > $(window).height() + $("#featuredAlbumsTitle").height()) {
				$("#featuredAlbumsTitle").fadeIn(500);
				var d = 200;
				$("#featuredAlbums > a").each(function() {
					$(this).delay(d).fadeIn(500);
					d += 500;
				});
			}
		});
		$.get("scripts/GetSummaries.php", function(data) {
			var response = JSON.parse(data);
			if(response.success) {
				var summaries = response.summaries;
				summaryImageMax = summaries.length;
				
				$("#summaryImageMax").html(summaryImageMax);
				$("#summaryImageNumber").html(summaryImage + 1);
				$("#summaryImage").attr('src', summaries[summaryImage].image);
				$("#summaryText").html(summaries[summaryImage].summary);
				$("#btnSummaryLeft").click(function(e) {
					e.preventDefault();
					summaryImage--;
					if(summaryImage < 0) {
						summaryImage = summaryImageMax - 1;
					}
					
					$("#summaryImageNumber").html(summaryImage + 1);
					$("#summaryImage, #summaryText").fadeOut(400, function() {
						$("#summaryImage").attr('src', summaries[summaryImage].image);
						$("#summaryText").html(summaries[summaryImage].summary);
					})
					.fadeIn(400);
				});
				$("#btnSummaryRight").click(function(e) {
					e.preventDefault();
					summaryImage++;
					if(summaryImage >= summaryImageMax) {
						summaryImage = 0;
					}
					
					$("#summaryImageNumber").html(summaryImage + 1);
					$("#summaryImage, #summaryText").fadeOut(400, function() {
						$("#summaryImage").attr('src', summaries[summaryImage].image);
						$("#summaryText").html(summaries[summaryImage].summary);
					})
					.fadeIn(400);
				});
			}
		});
	</script>
</body>
</html>

<?php
	if(!isset($_GET['id'])) {
		header("Location: /");
	}
	
	require_once 'scripts/utils/database.php';
	require_once 'scripts/connectors/AlbumConnector.php';
	require_once 'scripts/connectors/CategoryConnector.php';
	
	$cat = intval($_GET['id']);
	$AlbumConnector = new AlbumConnector($conn);
	$CategoryConnector = new CategoryConnector($conn);
	
	$category = $CategoryConnector->select($cat);
	$albums = $AlbumConnector->selectByCategory($cat);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Clara Ho - <?php echo $category[CategoryConnector::$COLUMN_CATEGORY]; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/common.css">
	
	<style>
		.thumbnail {
			border-top: 1vh solid #fff;
			border-left: 1vh solid #fff;
		}
	</style>
</head>
<body>
	<?php require_once "nav.php"; ?>
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" width="100%">
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item fill-screen active">
				<img class="d-block img-fluid" src="<?php echo $category[CategoryConnector::$COLUMN_COVER]; ?>" alt="Main Image">
			</div>
		</div>
	</div>
	<!--<div style="text-align: center; vertical-align: middle; line-height: 5vh; width: 100%; height: 5vh; position: relative; top: -20vh; z-index: 99; font-size: 20px">
		<p id="section05">
			<a id="scrollDown" href="#">View Albums<span></span></a>
		</p>
	</div>-->
	<div style="text-align: center; position: relative; top: -35vh; z-index: 99; color: white; height: 0">
		<h1 style="font-family: 'Stalemate', Arial, sans-serif; font-size: 11em; font-weight: bold"><?php echo $category[CategoryConnector::$COLUMN_CATEGORY]; ?></h1>
		<p style="font-family: 'Stalemate', Arial, sans-serif; font-size: 3em; position: absolute; top: 20vh; width: 100%">
			<?php echo $category[CategoryConnector::$COLUMN_DESCRIPTION]; ?>
		</p>
	</div>
	<div id="albums" class="container" width="100%" style="margin-top: 2vh; opacity: 1; color: #666666">
		<div class="row">
			<?php
				for($i = 0; $i < count($albums); $i++) {
					echo "<a href=\"view.php?id=" . $albums[$i][AlbumConnector::$COLUMN_ID] . "\" class=\"thumbnail col-md-4\" data-content=\"" . $albums[$i][AlbumConnector::$COLUMN_NAME] . "\">\n";
					echo "\n<img src=\"" . $albums[$i][AlbumConnector::$COLUMN_COVER] . "\" style=\"opacity: 0;\">\n";
					echo "</a>\n";
				}
			?>
		</div>
	</div>
	<div class="container">
		<hr>
	</div>
	<div style="text-align: center; vertical-align: middle; line-height: 5vh; width: 100%; height: 5vh; font-size: 8px; ">
		&copy; 2017 Clara Ho Photography
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var imagePositions = new Array();
		$(document).ready(function() {
			$(".carousel-item").css('width', $(window).width());
			$(".fill-screen").css('height', $(window).height() / 2);
			$(".thumbnail").css('height', $(".thumbnail").width());
			
			$(".thumbnail > img").each(function() {
				var $el = $(this);
				var img;
				img = new Image();
				img.onload = function () {
					if(this.width < this.height) {
						$el.addClass('portrait');
					}
				};
				img.src = $el.attr('src');
			});
			
			$('#scrollDown').click(function(e) {
				e.preventDefault();
				$("#albums").animate({ opacity: 1 }, { queue: false, duration: 'slow' });
				$('html, body').animate({ scrollTop: $(window).height() / 2}, $(window).height() / 2, 'swing');
				$(".fill-screen").css('height', $(window).height());
			});
			
			$("a > img").each(function() {
				imagePositions.push($(this));
				
				var scrollPos = $(document).scrollTop();
				if(scrollPos > $(this).offset().top - $(window).height()) {
					$(this).animate({ opacity: 1 }, { queue: false, duration: 'slow' });
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
		});
	</script>
</body>
</html>

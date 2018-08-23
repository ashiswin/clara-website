<?php
	require_once 'scripts/utils/database.php';
	require_once 'scripts/connectors/AlbumConnector.php';
	require_once 'scripts/connectors/BannerConnector.php';

	$AlbumConnector = new AlbumConnector($conn);

	$albums = $AlbumConnector->selectAll();

	$events = $AlbumConnector->selectByCategory(8);
	$weddings = $AlbumConnector->selectByCategory(7);
	$portraits = $AlbumConnector->selectByCategory(9);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clara Ho Photography</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link rel="stylesheet" href="fonts/fonts.css">
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<div class="container container-small">
		<div class="row">
			<span class="title">CLARA HO PHOTOGRAPHY</span>
			<span class="subtitle"><?php echo file('config/bannerSubtitle.txt')[0]; ?></span>
		</div>
		<nav class="navbar navbar-expand-sm navbar-light bg-clear flex-nowrap" style="margin-top: 2vh">
			<div class="justify-content-center" style="margin: auto;">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link text-white" href="#">HOME</a>
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
		<img id="slideshow" width="100%">
	</div>
	
	<div class="container container-small" id="underbanner">
		<div class="row">
			<div class="col-md-6" style="border-right: dotted; border-width: 0.5px; border-color: #CCCCCC">
				<h3>HELLO THERE!</h3>
				<hr>
				<p style="margin-top: 8vh;">
					“The best thing about a picture is that it never changes, even when the people in it do.”
				</p>
			</div>
			<div class="col-md-6" style="height: 100%;">
				<h3>GET CONNECTED</h3>
				<hr>
				<p style="margin-top: 10vh;">
					<a href="facebook.com" class="social-link"><i class="fab fa-facebook-f"></i></a>
					<a href="https://www.instagram.com/hpyclara/" class="social-link"><i class="fab fa-instagram"></i></a>
					<a href="https://sg.carousell.com/clarahohohoho/" class="social-link""><img src="img/carousell.png" style="width: 2vh; margin-top: -0.5vh;"></a>
				</p>
			</div>
		</div>
	</div>
	<h3>RECENT EVENTS</h3>
	
	<div class="container container-small">
		<div class="row gallery center-block" style="margin: 2vh auto;">
		<?php
			for($i = 0; $i < count($albums); $i++) {
				list($width, $height, $type, $attr) = getimagesize($albums[$i][AlbumConnector::$COLUMN_COVER]);

				if($width > $height) {
					echo "<div class=\"thumbnail\" style=\"background: url('" . $albums[$i][AlbumConnector::$COLUMN_COVER] . "') 50% 50%/auto 100% no-repeat; /* 50% 50% centers image in div */\">";
				}
				else {
					echo "<div class=\"thumbnail\" style=\"background: url('" . $albums[$i][AlbumConnector::$COLUMN_COVER] . "') 50% 50%/100% auto no-repeat; /* 50% 50% centers image in div */\">";
				}
				echo "<a href=\"album.php?id=" . $albums[$i][AlbumConnector::$COLUMN_ID]. "\"><span class=\"album-title\">" . $albums[$i][AlbumConnector::$COLUMN_NAME] . "</span><br><span class=\"description\">" . $albums[$i][AlbumConnector::$COLUMN_DESCRIPTION] . "</span></a>";
				echo "</div>";

				if(($i + 1) % 3 == 0) {
					echo "</div>";
					echo "<div class=\"row gallery center-block\" style=\"margin: -1vh auto;\">";
				}
			}

			if(($i + 1) % 3 != 0) {
				echo "</div>";
				echo "<div class=\"row gallery center-block\" style=\"margin: -1vh auto;\">";
			}
		?>
	</div>
	
	<div class="container container-small" style="margin-top: 15vh; margin-bottom: 5vh">
		<footer>
			Clara Ho Photography | Singapore Wedding Photographer | Best Singapore Wedding Photographer | Top Singapore Wedding Photographer
		</footer>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
		<?php
			$BannerConnector = new BannerConnector($conn);
			$images = $BannerConnector->selectAll();

			$slides = "";
			for($i = 0; $i < count($images); $i++) {
				$slides .= "'" . $images[$i][BannerConnector::$COLUMN_IMAGE] . "'";
				if($i != count($images) - 1) {
					$slides .= ",";
				}
			}
			echo "var slides = [" . $slides . "];";
		?>
		var currentSlide = 0;
		$("#slideshow").attr('src', slides[currentSlide]);

		var tid = setInterval(slideshow, 5000);
		function slideshow() {
			$("#slideshow").fadeOut(1000, function() {
				$("#slideshow").attr('src', slides[currentSlide]);
			})
			.fadeIn(2000);
			currentSlide = (currentSlide + 1) % slides.length;
		}
	</script>
</body>
</html>
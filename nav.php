<nav class="navbar navbar-toggleable-md navbar-light bg-white" style="z-index: 100;">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="/" style="padding-left: 2vh; font-family: 'Stalemate', Arial, sans-serif; font-size: 3em; font-weight: bold; margin-bottom: -2vh; margin-top: -2vh; padding-top: 15px">Clara Ho</a>

	<div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right: 2vh">
		<ul class="navbar-nav ml-auto">
			<li id="navHome" class="nav-item" style="padding-right: 1vh"><a href="/" class="nav-link" style="font-size: 1.2em;">Home</a></li>
			<li class="nav-item dropdown" style="padding-right: 1vh">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 1.2em;">
					Portfolio
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<?php
						require_once 'scripts/utils/database.php';
						require_once 'scripts/connectors/CategoryConnector.php';
						
						$CategoryConnector = new CategoryConnector($conn);
						$categories = $CategoryConnector->selectAll();
						
						for($i = 0; $i < count($categories); $i++) {
							echo "<a class=\"dropdown-item\" href=\"categories.php?id=" . $categories[$i][CategoryConnector::$COLUMN_ID] . "\">" . $categories[$i][CategoryConnector::$COLUMN_CATEGORY] . "</a>";
						}
					?>
				</div>
			</li>
			<li id="navAbout" class="nav-item" style="padding-right: 1vh"><a href="about.php" class="nav-link" style="font-size: 1.2em;">About</a></li>
			<li id="navContact" class="nav-item" style="padding-right: 1vh"><a href="contact.php" class="nav-link" style="font-size: 1.2em;">Contact</a></li>
			<li id="navInstagram" class="nav-item" style="padding-right: 1vh"><a href="https://www.instagram.com/hpyclara/" class="nav-link"  style="font-size: 1.2em;"><img src="img/instagram.png"></a></li>
		</ul>
	</div>
</nav>

<!DOCTYPE html>
<html>
<head>
	<title>Clara Ho - Admin</title>
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
	</style>
</head>
<body>
	<div class="container">
		<h1 style="font-family: 'Stalemate', Arial, sans-serif; font-size: 12em; text-align: center; margin-top: 2vh">Clara Ho</h1>
		<div class="offset-md-4 col-md-4">
			<form class="form">
				<input id="txtUsername" type="text" class="form-control" placeholder="Username" />
				<input id="txtPassword" type="password" class="form-control" placeholder="Password" />
				<button class="btn btn-primary" style="width: 100%" id="btnLogin">Login</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$("#btnLogin").click(function(e) {
			e.preventDefault();
			
			$(this).addClass("disabled").attr('disabled', 'true');
			$(this).html("Logging in <i class=\"fa fa-refresh spinning\" aria-hidden=\"true\"></i>");
			
			var username = $("#txtUsername").val();
			var password = $("#txtPassword").val();
			
			$.post("../scripts/Authenticate.php", { username: username, password: password }, function(data) {
				response = JSON.parse(data);
				if(response.success) {
					$("#btnLogin").addClass("btn-success").removeClass("btn-primary");
					$("#btnLogin").html("Success!");
				}
				else {
					$("#btnLogin").removeClass("disabled").removeAttr('disabled');
					$("#btnLogin").html("Login");
					
					$("#txtUsername")[0].setCustomValidity(response.message);
					$("#txtUsername")[0].reportValidity();
				}
			});
		});
	</script>
</body>
</html>

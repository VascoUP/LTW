<?php
	include_once('config/init.php');

	if(isset($_SESSION['username'])) {
		$stmt = $conn->prepare('SELECT ProfilePicture FROM User WHERE username = ? LIMIT 1');
		$stmt->execute(array($_SESSION['username']));

		$result = $stmt->fetch();

		$url = "Database/ProfilePictures/".$result['ProfilePicture'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Aelius</title>
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/initialStyle.css">
		<link rel="stylesheet" href="css/loginForm.css">
		<script 
			src="https://code.jquery.com/jquery-3.1.1.min.js" 
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" 
			crossorigin="anonymous"></script>
		<script
			src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
			integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
			crossorigin="anonymous"></script>	
		<script src="scripts/search.js"></script>	
		<script src="scripts/logButtons.js"></script>
	</head>
	<body>
		<header>
			<img src="images/logo.png" alt="AELIUS"/>
			<?php 
				if(isset($_SESSION['username'])) {
   					echo '<img src="'.$url.'" id="UserProfileHeader" class="ProfileHeader" onclick="showScrollDown()"/>';
				} else 
				 	echo '<img src="images/no-user-image-header.png"  
				 		class="ProfileHeader" onclick="loginButton()"/>';
			?>
			<h1>Aelius</h1>
		</header>
		<?php
			include ('templates/profileScrollDown.php');
			include ('templates/search_form.php');
			if (!isset($_SESSION['username'])) {
				echo '<ul id="log_site">';
					echo '<li>';
						include ('templates/register.php');
					echo '</li>';
					echo '<li>';
		?>
					<div class="sexy_border"> </div>
		<?php
						include ('templates/login.php');
					echo '</li>';
				echo '</ul>';
			} else {
				echo '<ul id="log_site">';
				echo '<li>';
					include ('templates/logout.php');
				echo '</li>';
			}
		include ('templates/LoginForm.php');
		?>
	</body>
</html>


<?php
	include_once('config/init.php');
	global $conn;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>AELIUS</title>
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/initialStyle.css">
		<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" 		
			crossorigin="anonymous"></script>	
		<script src="scripts/search.js"></script>	
		<script src="scripts/logButtons.js"></script>
	</head>
	<body>
		<header>
			<img src="images/logo.png" alt="AELIUS"/>
			<h1>AELIUS</h1>
		</header>
		<?php
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


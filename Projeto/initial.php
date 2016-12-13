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
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<link rel="stylesheet" href="css/loginForm.css">
	</head>
	<body>
		<header>
			<?php
			include ("templates/HeaderButtons.php");
			include ('templates/HeaderScrollDown.php');
			?>
		</header>
		<?php
			include ('templates/searchForm.php');
			include ('templates/LoginForm.php');
		?>
	</body>
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
</html>


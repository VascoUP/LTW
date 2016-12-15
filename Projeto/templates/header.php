<?php
	include_once('config/init.php');
	include_once('Database/restaurant.php');
	include_once('Database/user.php');

	if(isset($_SESSION['username'])) {
		$stmt = $conn->prepare('SELECT ProfilePicture FROM User WHERE username = ? LIMIT 1');
		$stmt->execute(array($_SESSION['username']));

		$result = $stmt->fetch();
		if( !$result['ProfilePicture'] || $result['ProfilePicture'] == "NULL" )
			$url = "images/no-user-image.jpg";
		else
			$url = "Database/ProfilePictures/Thumbnail/".$result['ProfilePicture'];
	}
?>

	<script type="text/javascript" src="scripts/logButtons.js"></script>	
</head>
<body>
	<div id="wrapper">
		<header>
			<a href="initial.php"><img src="images/logo.png" alt="AELIUS"/></a>
			<?php
				include ("templates/HeaderButtons.php");
				include ('templates/HeaderScrollDown.php');
			?>  
		</header>

<?php
	include_once('config/init.php');
	include ('templates/head.php');
?>
	<link rel="stylesheet" href="css/registerForm.css">
    	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    	<script type="text/javascript" src="scripts/registrationForm.js"></script>	
<?php
	include ('templates/header.php');
?>
			<div id="content">
<?php
	include ('templates/profile_form.php');
	if(!isset($_SESSION['username']))
		include ('templates/LoginForm.php');
?>
			</div>
		</div><!-- End of wrapper -->
	</body>
</html>

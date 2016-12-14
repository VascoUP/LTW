<?php
	include_once('config/init.php');
	include_once('Database/restaurant.php');
	include ('templates/head.php');
?>
	<script src="scripts/restaurant_form.js"></script>
<?php
	include ('templates/header.php');
?>
	<div id="content">
<?php
	include ('templates/restaurant_form.php');
	if(!isset($_SESSION['username']))
		include ('templates/LoginForm.php');
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

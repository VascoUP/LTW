<?php
	include_once('config/init.php');  
	include ('templates/head.php');
?>
<!-- Include scripts here -->
	<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" 		
		crossorigin="anonymous"></script>
<?php
	include ('templates/header.php');
?>
	<div id="content">
<?php
	include ('templates/search_form.php');
?>
	<div id="Restaurant_Page">
<?php
	include ('templates/restaurant_photo.php');
	include ('templates/restaurant_overview.php');
?>
	</div>
<?php
	include ('templates/login_form.php');
	include ('templates/register_form.php');
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

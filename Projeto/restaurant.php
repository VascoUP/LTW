<?php
	include_once('config/init.php');  
	include ('templates/head.php');
?>
<!-- Include scripts here -->
	<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" 		
		crossorigin="anonymous"></script>
	<script src="scripts/search.js"></script>
	<script src="scripts/restaurant.js"></script>
<?php
	include ('templates/header.php');
?>
	<div id="content">
<?php
	include ('templates/search_form.php');
	include ('templates/restaurant_page.php');
	include ('templates/LoginForm.php');
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

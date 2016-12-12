<?php
	include_once('config/init.php');
	include_once('Database/getRestaurantInfo.php');

	include ('templates/head.php');
?>
<!-- Include scripts here -->
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

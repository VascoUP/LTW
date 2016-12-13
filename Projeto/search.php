<?php
	include_once('config/init.php');  
	include ('templates/head.php');
	include ('Database/restaurant.php');
?>
<!-- Include scripts here -->
	<script src="scripts/search.js"></script>	
<?php
	include ('templates/header.php');
?>
	<div id="content">
<?php
	
	$searchString = $_GET['restaurant'];
	$restaurants = getSearchRestaurants($searchString);

	include ('templates/searchForm.php');
	include ('templates/listRestaurants.php');
	if(!isset($_SESSION['username']))
		include ('templates/LoginForm.php');
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

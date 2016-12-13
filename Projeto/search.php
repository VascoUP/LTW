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
	
	$category = $_GET['searchOption'];
	$searchString = $_GET['searchString'];

	switch ($category) {
		case 'Name':
			$restaurants = getRestaurantsByName($searchString);
			break;
		case 'Category':
			$restaurants = getRestaurantsByCategory($searchString);
			break;
		case 'City':
			//$restaurants = getRestaurantsByCity($searchString);
			break;
		default:
			break;
	}

	include ('templates/searchForm.php');
	include ('templates/listRestaurants.php');
	if(!isset($_SESSION['username']))
		include ('templates/LoginForm.php');
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

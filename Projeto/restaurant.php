<?php
	include_once('config/init.php');  
	include ('templates/head.php');
?>
<!-- Include scripts here -->
	<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" 		
		crossorigin="anonymous"></script>
	<script src="scripts/restaurant.js"></script>	
	<script src="scripts/init_map.js"></script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDz6lPZunWs-mrqaJL_30X7753DuWkEBWs&callback=initMap">
	</script>
<?php
	include ('templates/header.php');
?>
	<div id="content">
<?php
	include ('templates/search_form.php');
	include ('templates/restaurant_page.php');
	include ('templates/login_form.php');
	include ('templates/register_form.php');
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

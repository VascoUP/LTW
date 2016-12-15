<?php
	include_once('config/init.php');
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
	include ('templates/searchForm.php');
	include ('templates/restaurant_page.php');
	if(!isset($_SESSION['username']))
		include ('templates/LoginForm.php');

	echo '<div id="PopupWrapper">';
	echo '<span id="PopupClose" onclick="hidePopup()")>&times;</span>';
	echo '<img id="PopupImage"/>';
	echo '<div id="PopupCaption"></div>';
	echo '</div>';
?>
	</div>
<?php
  	include ('templates/footer.php');
?>

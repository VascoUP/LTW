<div id="Restaurant_Page">
<?php
	include ('templates/restaurant_photo.php');
?>
	<ul id="Restaurant_Menu">
		<li id="Rst_Menu_Ov">
			<p>Overview</p>
			<div class="Selected_Item"></div>
		</li>
		<li id="Rst_Menu_Mn">
			<p>Menu</p>
			<div class="Unselected_Item"></div>
		</li>
		<li id="Rst_Menu_Rv">
			<p>Reviews</p>
			<div class="Unselected_Item"></div>
		</li>
		<li id="Rst_Menu_Pht">
			<p>Photos</p>
			<div class="Unselected_Item"></div>
		</li>
	</ul>
<?php
	include ('templates/restaurant_overview.php');
?>
</div>


<ul id="restaurants_list">

	<?php 
		foreach($userFavourites as $restaurantID) {
		$restaurant = getRestaurantInfo($restaurantID['Restaurant_ID']);
	?>
		<li> 
			<a href="restaurant.php" onclick="location.href=this.href+'?id=<?=$restaurant['ID']?>';return false;" class="Hide_Link_Display">
				<div class="Restaurant_Opt">
					<img src="images/logo.png" alt="photo">
					<h3 class="Restaurant_Name"> <?php echo $restaurant['Name']?> </h3>
					<?php
						include('templates/score.php');
					?>
					<p class="restaurant_street_name"> <?php 
						$Address = getAddress($restaurant['Address_ID']);
						echo $Address['StreetName'];
					?></p>
				</div>	
			</a>
			<div class="Sexy_Border">
			</div>
		</li>
	<?php } ?>	
</ul>


<ul id="restaurants_list">

	<?php 
		if( isset($restaurants) ) {
			$index = 0;
			foreach($restaurants as $restaurant) {
				if( $index != 0 ) { 
	?>
				<div class="Sexy_Border">
				</div>
				<?php 
				} 
				?>
		<li> 
			<a href="restaurant.php" onclick="location.href=this.href+'?id=<?=$restaurant['ID']?>';return false;" class="Hide_Link_Display">
				<div class="Restaurant_Opt">
					<?php
						$thumbnail = "Database/RestaurantPictures/Thumbnail/".
								getRestaurantThumbnailPicture($restaurant['ID'])['Name'];
					?>
					<img src=<?=$thumbnail?> alt="photo">
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
		</li>
	<?php
				$index++;
			} 
		}
	?>	
</ul>

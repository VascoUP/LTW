<div class="Margin_Top_Bottom Curved_Edges Restaurant_Photo">
	<!-- <img src="images/background_search.jpg" alt="restaurant" /> -->
	<?php
		if(isset($_SESSION['username'])) {
	?>
		<?php
			if(isFavorite($restaurantID)) {
		?>
			<label id="favoriteStar" for="favoriteCheckbox" style="color:yellow">&#9733</label>
			<input hidden id="favoriteCheckbox" type="checkbox" onchange="updateFavorite(this)" checked/>
		<?php } else { ?>
			<label id="favoriteStar" for="favoriteCheckbox" style="color:black">&#9733</label>
			<input hidden id="favoriteCheckbox" type="checkbox" onchange="updateFavorite(this)"/>
		<?php } ?>
	<?php } ?>

	<div class="Restaurant_Basic_Info">
		<h3 class="Restaurant_Name">
		<?php
	    		echo $restaurant['Name'];
		?>
		</h3>
		<div class="Score">
			<?php
				if($restaurant['NScores'] > 0) {
					$score = $restaurant['TotalScores'] / $restaurant['NScores'];
					echo "<h3 class='Max_Score'>/10</h3>";
		    			echo "<h3>$score</h3>";
				} else {
					echo "<h3>No reviewes";
				}
			?>
		</div>
	</div>
</div>

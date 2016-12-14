<?php
	global $restaurant_name;
	global $restaurant_total_scores;
	global $restaurant_nscores;
?>

<div class="Curved_Edges Favourite_Restaurant_Photo">
	<!-- <img src="images/background_search.jpg" alt="restaurant" /> -->
	<div class="Restaurant_Basic_Info">	
		<h3 class="Restaurant_Name"> 
		<?php
			echo $restaurant_name;
		?>
		</h3>
		<div class="Score">
			<h3 class="Max_Score"> /10 </h3>
			<h3> 
			<?php 
				if($restaurant_nscores == 0)
					echo 0;
				else 
					echo $restaurant_total_scores/$restaurant_nscores;
			?>
			</h3>		
		</div>
	</div>
</div>

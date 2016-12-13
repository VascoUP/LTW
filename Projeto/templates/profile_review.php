<?php
	global $restaurant_name;
	global $review_date;
	global $review_score;
	global $review_text;
?>

<div class="review">
	<div class="Restaurant_Reviewed">
		<p>
		<?php
			echo $restaurant_name;
		?>
		</p>
	</div>
	<div class="Review_Date">
		<p>
		<?php
			echo $review_date;
		?></p>
	</div>
	
	<div class="Review_Score">
		<p>
		<?php
			echo $review_score;
		?>/5</p>
	</div>
	<div class="Review_Text">
		<p>
		<?php
			echo $review_text;
		?>
		</p>
	</div>
</div>
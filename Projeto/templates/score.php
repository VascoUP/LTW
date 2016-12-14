<<<<<<< HEAD
<div class="Score">
	<h3 class="Max_Score"> /10 </h3>
	<h3> <?php 
			if($restaurant['NScores'] == 0)
				echo 0;
			else 
				echo $restaurant['TotalScores']/$restaurant['NScores'];
		?> 
	</h3>		
</div>
=======
<div class="Score">
	<h3 class="Max_Score"> /10 </h3>
	<h3> 
	<?php 
		if($restaurant['NScores'] == 0)
			echo 0;
		else 
			echo $restaurant['TotalScores']/$restaurant['NScores'];
	?> 
	</h3>		
</div>
>>>>>>> 59cc73e2f3b0a7fdfb3e5650e4b5497612e3093a

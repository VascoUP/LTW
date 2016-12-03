<div id="Restaurant_Page">
<?php
	include ('templates/restaurant_photo.php');
?>
	<ul class="Curved_Edges Margin_Top_Bottom Default_Info_Box Text_Align_Center" id="Restaurant_Nav">
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

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Overview">
		<div class="Text_Align_Center" id="Overview_Col1">
			<div id="Overview_Phone">
				<p class="Overview_Title" id="Phone_Title">Phone Number</p>
				<p id="Phone_Number">916383796</p>
			</div>
			<div id="Overview_Categories">
				<p class="Overview_Title" id="Categories_Title">Categories</p>
				<ul id="Ov_Categories">
					<li class="Ov_Category">Breakfast</li>
				</ul>
			</div>
		</div>
		<div class="Text_Align_Center" id="Overview_Col2">
			<div id="Overview_Avg_Cost">
				<p class="Overview_Title" id="Avg_Cost_Title">Average Cost</p>
				<p id="Avg_Cost">15€ per person</p>
			</div>
			<div id="Overview_Op_Hours">
				<p class="Overview_Title" id="Op_Hours_Title">Opening Hours</p>
				<p id="Op_Hours_Week">7:30h to 22:00h</p>
				<p id="Op_Hours_Weekend">8:00h to 23:00h</p>
				<p id="Ov_Closed">Closed at Sundays and Mondays</p>
			</div>
		</div>
		<div class="Sexy_Border">
		</div>
		<div class="Text_Align_Center" id="Overview_Map">
			<h2 class="Text_Align_Center">Address</h2> 
			<div id="map"></div>
		</div>
	</div>

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Menu">
		<h2 class="Text_Align_Center">Menu</h2>
	</div>

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Reviews">
		<h2 class="Text_Align_Center">Reviews</h2>
	</div>	

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Photos">
		<h2 class="Text_Align_Center">Album</h2>
	</div>
</div>

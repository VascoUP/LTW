<?php
	global $rst;
	global $add;
	global $cats;
?>

<div id="Restaurant_Page">
<?php
	include ('templates/restaurant_photo.php');
?>
	<div id="sticky-anchor"></div>
	<div id="sticky-element">
		<ul class="Curved_Edges Default_Info_Box Text_Align_Center" id="Restaurant_Nav">
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
	</div>

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Overview">
		<div class="Text_Align_Center">
			<p class="Overview_Title">Description</p>
			<p>
			<?php
				$desc = $rst['Description'];
				echo $desc;
			?>
			</p>
		</div>
		<div class="Text_Align_Center" id="Overview_Col1">
			<div id="Overview_Phone">
				<p class="Overview_Title" id="Phone_Title">Phone Number</p>
				<p id="Phone_Number">
		<!-- To be changed -->
					916383796
				</p>
			</div>
			<div id="Overview_Categories">
				<p class="Overview_Title" id="Categories_Title">Categories</p>
				<ul id="Ov_Categories">
		<!-- To be changed -->    
				<?php
					foreach($cats as $row) {
						echo "<li class='Ov_Category'>";
						$cat_id = $row['Category_ID'];
						echo $cat_id;
						echo "</li>";
					}
				?>
				</ul>
			</div>
		</div>
		<div class="Text_Align_Center" id="Overview_Col2">
			<div id="Overview_Avg_Cost">
				<p class="Overview_Title" id="Avg_Cost_Title">Average Cost</p>
				<p id="Avg_Cost">
				<?php
					$price = $rst['Price'];
					echo "$price per person";
				?>
				</p>
			</div>
			<div id="Overview_Op_Hours">
		<!-- To be changed -->
				<p class="Overview_Title" id="Op_Hours_Title">Opening Hours</p>
				<p id="Op_Hours_Week">7:30h to 22:00h</p>
				<p id="Op_Hours_Weekend">8:00h to 23:00h</p>
				<p id="Ov_Closed">Closed at Sundays and Mondays</p>
			</div>
		</div>
		<div class="Sexy_Border">
		</div>
		<div class="Text_Align_Center" id="Overview_Map">
			<h2>Address</h2> 
			<p>
			<?php
				$street_name = $add['StreetName'];
				echo $street_name;
			?>
			</p>
			<p hidden id="Lat"><?php
				$lat = $add['Latitude'];
				echo $lat;
			?></p>
			<p hidden id="Lon"><?php
				$lon = $add['Longitude'];
				echo $lon;
			?></p>
			<div id="map"></div>	
			<script src="scripts/init_map.js"></script>
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDz6lPZunWs-mrqaJL_30X7753DuWkEBWs&callback=initMap">
			</script>
				</div>
	</div>

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Menu">
		<h2 class="Text_Align_Center">Menu</h2>
	</div>

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Reviews">
		<div class="Restaurant_Review">
			<!-- Add comment and score -->

			<div class="Review_Reply"> 
				<!-- Add reply -->
			</div>
		</div>
		<form id="Review_Form">
			<div id="Add_Score">
				<ul>
					<li id="Score1" class="Curved_Edges Unselected_Score"></li>
					<li id="Score2" class="Curved_Edges Unselected_Score"></li>
					<li id="Score3" class="Curved_Edges Unselected_Score"></li>
					<li id="Score4" class="Curved_Edges Unselected_Score"></li>
					<li id="Score5" class="Curved_Edges Unselected_Score"></li>
					<li id="Total_Score">0</li>
				</ul>
			</div>
			<textarea id="Review_Comment" rows="1" placeholder="Write a review..." class="Unselected_TextArea"></textarea>
			<input type="button" value="Submit" id="Submit_Review" class="style_button Unselected_Button">
		</form>
	</div>	

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Photos">
		<h2 class="Text_Align_Center">Album</h2>
	</div>
</div>

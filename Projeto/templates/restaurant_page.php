<?php
	$restaurantID = $_GET['id'];
	$restaurant = getRestaurantInfo($restaurantID);
	if( !$restaurant )
		header("Location: Error.php");

	$restaurantAddress = getAddress($restaurant['Address_ID']);
	
	$restaurantCategories = getRestaurantCategories($restaurantID);

	$restaurantOpenHours = getRestaurantOpenHours($restaurantID);

	$restaurantMenus = getMenus($restaurantID);

	$restaurantPictures = getRestaurantThumbnailPictures($restaurantID);

	$restaurantReviews = getRestaurantReviews($restaurantID);
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
					echo $restaurant['Description'];
				?>
			</p>
		</div>
		<div class="Text_Align_Center" id="Overview_Col1">
			<div id="Overview_Phone">
				<p class="Overview_Title" id="Phone_Title">Phone Number</p>
				<p id="Phone_Number">
					<?php
						echo $restaurant['PhoneNumber'];
					?>
				</p>
			</div>
			<div id="Overview_Categories">
				<p class="Overview_Title" id="Categories_Title">Categories</p>
				<ul id="Ov_Categories">   
					<?php
						foreach($restaurantCategories as $row) {
							$category = getCategory($row['Category_ID'])['Category'];
							echo "<li class='Ov_Category'>
								<a href='search.php?searchOption=Category&searchString=$category'>
								$category</a>
								</li>";
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
					echo $restaurant['Price'].'per person';
				?>
				</p>
			</div>
			<div id="Overview_Op_Hours">
				<p class="Overview_Title" id="Op_Hours_Title">Opening Hours</p>

				<?php
					foreach($restaurantOpenHours as $openHour)
						echo '<p class="Op_Hours_Week">'.getOpenHour($openHour['OpenHour_ID'])['Day'].":<br>".getOpenHour($openHour['OpenHour_ID'])['OpenTime']." to ".getOpenHour($openHour['OpenHour_ID'])['CloseTime']."</p>";
				?>
			</div>
		</div>
		<div class="Sexy_Border">
		</div>
		<div class="Text_Align_Center" id="Overview_Map">
			<h2>Address</h2> 
			<p>
			<?php
				echo $restaurantAddress['StreetName'];
			?>
			</p>
			<p hidden id="Lat"><?php
				$lat = $restaurantAddress['Latitude'];
				echo $lat;
			?></p>
			<p hidden id="Lon"><?php
				$lon = $restaurantAddress['Longitude'];
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
		<?php
			$category = "";
			$class_table = "Menu_Table";
			$class_category = "Table_Category";
			$class_food = "Menu_Food";
			$class_price = "Menu_Price";

			foreach($restaurantMenus as $row) {
				if( $row['Category'] != $category ) {
					if( $category != "" ) {
						echo "</table>";
						echo "<div class='Sexy_Border'></div>";
					}

					$category = $row['Category'];

					echo "<p class='$class_category Text_Align_Center'>$category</p>";
					echo "<table class='$class_table'>";
				}

				$food = $row['Food'];
				$price = $row['Price'];
				echo "<tr><td class='$class_food'>$food</td><td class='$class_price'>$price</td></tr>";
			}
			if( $category != "" )
				echo "</table>";
		?>
	</div>

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Reviews">

		<?php
			$index = 0;
			foreach($restaurantReviews as $review) {
				if( $index != 0 ) {
		?>
					<div class='Sexy_Border'></div>
		<?php		}
		?>
			<div class="RestaurantReview">
				<div class="ReviewInfo">
					<p class="ReviewUsername">
					<?php
						echo $review['Username'];
					?>
					</p>
					<p class="ReviewScore">
					<?php
						echo $review['Score'];
					?>
					</p>
					<p class="GeneralDate">
					<?php
						echo $review['DateReview'];
					?>
					</p>
					<div class="GeneralContent">
					<?php
						echo $review['Content'];
					?>
					</div>
				</div>

				<?php 
					$replys = getReplys($review['ID']);

					foreach($replys as $reply) {
				?>

					<div class="ReviewReply">
						<div class="CommentInfo">
							<p class="CommentUsername" >
							<?php
								echo $reply['Username'];
							?>
							</p>
							<p class="GeneralDate">
							<?php
								echo $reply['CommentDate'];
							?>
							</p>
						</div>
						<div class="GeneralContent">
						<?php
							echo $reply['Content'];
						?>
						</div>
					</div>
				<?php } ?>

			<?php 
				if(isset($_SESSION['username']) && $_SESSION['username'] == $restaurant['Owner_Username']) {
			?>
			<input class="AddCommentButton" type="button" value="Add Comment" data-id=<?=$review['ID']?> onclick="showReplyForm(this)">
				<div hidden class="ReplyWrapper" data-id=<?=$review['ID']?> >
					<textarea id="Reply_Comment" rows="1" placeholder="Write a reply..." class="Unselected_TextArea" data-id=<?=$review['ID']?> ></textarea>
					<input type="button" value="Submit" id="Submit_Reply" class="style_button Unselected_Button" data-id=<?=$review['ID']?> onclick="updateReplys(this)">
				</div>
				<?php
				}
				?>
			</div>
		<?php 
			$index++; 
		} 
		?>

		<?php 
			//if(isset($_SESSION['username']) && isUserReviewer($_SESSION['username'])) {
		?>
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
				<input type="button" value="Submit" id="Submit_Review" class="style_button Unselected_Button" onclick="updateReviews()">
			</form>
		<?php 
			//} 
		?>
	</div>	

	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Photos">
		<h2 class="Text_Align_Center">Album</h2>
		<div id="RestaurantImages">
			<?php
				foreach($restaurantPictures as $row) {
					$filePath = "Database/RestaurantPictures/Thumbnail/".$row['Name'];
					$alt = $restaurant['Name']." Image by ".$row['Username'];
			?>
					<div class="RestaurantImage">
				<?php
					echo '<img alt='.$alt.' src='.$filePath.' onclick="showPicturePopUp(this.src, this.alt)" />';
				?>
					</div>
			<?php
				}
			?>
		</div>
	</div>
</div>

<?php
	$restaurantID = $_GET['id'];
	if( $restaurantID )
		$exists = true;
	else 
		$exists = false;

	if( $exists ) {
		$restaurant = getRestaurantInfo($restaurantID);
		$restaurantAddress = getAddress($restaurant['Address_ID']);
		$restaurantCategories = getRestaurantCategories($restaurantID);
		$restaurantOpenHours = getRestaurantOpenHours($restaurantID);
		$restaurantMenus = getMenus($restaurantID);
	}
?>

<div id="Restaurant_Page">
	<div class="Curved_Edges Margin_Top_Bottom Default_Info_Box" id="Restaurant_Form">
		<h3 class="Overview_Title Text_Align_Center">
		<?php
			if( $exists ) 
				echo "Edit restaurant";
			else
				echo "Add new restaurant";
		?>
		</h3>

		<form id="Edit_Restaurant">
			<div class="Form_Param">
				<p class="Form_Specify">Nome: </p>
				<?php
					if( $exists ) {
						$value = $restaurant['Name'];
						echo "<input class='Form_Value' type='text' value='$value'>"; 
					} else
						echo "<input class='Form_Value' type='text'>"; 
				?>
			</div>

			<div class="Form_Param">
				<p class="Form_Specify">Description: </p>
				<?php
					if( $exists ) {
						$value = $restaurant['Description'];
						echo "<textarea class='Form_Value'>$value</textarea>"; 
					} else
						echo "<textarea class='Form_Value'></textarea>"; 
				?>
			</div>
		
			<div class="Form_Param">
				<p class="Form_Specify">Phone Number: </p>
				<?php
					if( $exists ) {
						$value = $restaurant['PhoneNumber'];
						echo "<input class='Form_Value' type='number' value='$value'>"; 
					} else
						echo "<input class='Form_Value' type='number'>"; 
				?>
			</div>

			<div class="Form_Param">
				<p class="Form_Specify">Categories: </p>
				<input class='Form_Value' type='text'><input id="Add_Category" type="button" value="Add">
				<ul id="Ov_Categories">
				<?php
					if( $exists ) {
						foreach($restaurantCategories as $row) {
							$category = getCategory($row['Category_ID'])['Category'];
							echo "<li class='Ov_Category'>";
							echo "<h5>$category</h5>";
							echo "<img src='images/delete_icon.png' alt='Delete'>";
							echo "</li>";
						}
					}
				?>
				</ul>
			</div>

			<div class="Form_Param">
				<p class="Form_Specify">Avg Cost: </p>
				<?php
					if( $exists ) {
						$value = $restaurant['Price'];
						echo "<input class='Form_Value' type='number' value='$value'>"; 
					} else
						echo "<input class='Form_Value' type='number'>";
					echo " per person";
				?>
			</div>
	
			<div class="Form_Param">
				<p class="Form_Specify">Open Hours: </p>
				<div class="Day_Of_Week">
					Monday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>				
				<div class="Day_Of_Week">
					Tuesday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>
				<div class="Day_Of_Week">
					Wednesday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>
				<div class="Day_Of_Week">
					Thursday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>
				<div class="Day_Of_Week">
					Friday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>
				<div class="Day_Of_Week">
					Saturday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>
				<div class="Day_Of_Week">
					Sunday<br>
					From <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
					To <input class='Form_Value' type='number'>:<input class='Form_Value' type='number'>
				</div>
			</div>

			<div class="Form_Param">
				<p class="Form_Specify">Address: </p>
				<?php
					if( $exists ) {
						$value = $restaurantAddress['StreetName'];
						echo "<input class='Form_Value' type='text' value='$value'>"; 
					} else
						echo "<input class='Form_Value' type='text'>";
				?>
			</div>			
			<div class="Form_Param">
				<p class="Form_Specify">Menu: </p>
				<input id="Menu_Item_Food" class='Form_Value' type='text' placeholder="Food"> - 
				<input id="Menu_Item_Price" class='Form_Value' type='number' placeholder="Price">€
				<input id="Menu_Item_Category" class='Form_Value' type='text' placeholder="Category">
				<input id="Add_Menu_Item" type="button" value="Add">
				<?php
					if( $exists ) {
						$category = "";
						$class_table = "Menu_Table";
						$class_category = "Table_Category";
						$class_food = "Menu_Food";
						$class_price = "Menu_Price";

						echo "<table class='$class_table'>";
						foreach($restaurantMenus as $row) {
							$food = $row['Food'];
							$price = $row['Price'];
							echo "<tr><td class='$class_food'>$food</td>
									<td class='$class_price'>$price</td>
									<td><img src='images/delete_icon.png' alt='Delete'></td></tr>";
						}
						echo "</table>";
					}
				?>
			</div>
			<input type="submit">
		</form>
	</div>
</div>

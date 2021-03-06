<?php
	$username = $_GET['username'];
	$userInfo = getUserInfoPhp($username);
	if( !$userInfo )
		header("Location: Error.php");
	$userReviews = getUserReviews($username);
	$userFavourites = getUserFavourites($username);
?>

<div class="profile_content">
	<div class="dashboard" id="left-dashboard">
		<div id="UserGeneralInfo"  class="Curved_Edges Default_Info_Box">
			<div id="profile-photo">
			<?php
				$picture = $userInfo['ProfilePicture'];
				if($picture == 'NULL') {
					echo "<img src='images/no-user-image.jpg' alt='profilePic' height='75' width='75'>";
				}
				else 
					echo "<img src='Database/ProfilePictures/Thumbnail/$picture' alt='profilePic' height='75' width='75'>";
			?>
			</div>
			<div id="profile-username">
				<h3> 
				<?php 
					echo $userInfo['Username']; 
				?> 
				</h3>
			</div>
			<div class="profile-bio">
				<p>
				<?php 
					echo $userInfo['Email']; 
				?> 				</p>
			</div>
						
			<div class="profile-stats">
				<ul class="Curved_Edges" id="Stat_Nav">
					<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'reviews')" id="defaultOpen">
						<p align="right">Reviews</p>
						<p align="right">
						<?php
							echo count($userReviews);
						?>
						</p>
					</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'favourites')">
						<p align="right">Favourites</p>
						<p align="right">
							<?php
								echo count($userFavourites);
							?>
						</p>
					</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="dashboard Curved_Edges" id="main">
		<div class="tabcontent" id="favourites">
			<?php 
				include("templates/listFavourites.php");
			?>
		</div>
			
		<div class="tabcontent Default_Info_Box" id="reviews">
		<?php
			foreach($userReviews as $review) {
				$restaurant_name = getRestaurantName($review['Restaurant_ID'])['Name'];
				$review_date = $review['DateReview'];
				$review_score = $review['Score'];
				$review_content = $review['Content'];	
		?>			
				<div class="ReviewInfo">
					<p class="ReviewUsername">
					<?php
						echo $restaurant_name;
					?>
					</p>
					<p class="ReviewScore">
					<?php
						echo $review_score;
					?>
					</p>
					<p class="GeneralDate">
					<?php
						echo $review_date;
					?>
					</p>
					<div class="GeneralContent">
					<?php
						echo $review_content;
					?>
					</div>
				</div>
		<?php
			}
		?>
		</div>
	</div>

</div>


<script>
	function openTab(evt, tabName) {
		// Declare all variables
		var i, tabcontent, tablinks;

		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the link that opened the tab
		document.getElementById(tabName).style.display = "block";
		evt.currentTarget.className += " active";
	}
		
	document.getElementById("defaultOpen").click();
</script>

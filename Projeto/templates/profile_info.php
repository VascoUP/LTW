<?php
	include('Database/user.php');
	include('Database/restaurant.php');

	$username = $_GET['username'];
	$userInfo = getUserInfoPhp($username);
	$userReviews = getUserReviews($username);
?>

<div class="profile_content">
	<div class="dashboard" id="left-dashboard">
		<div class="Curved_Edges Default_Info_Box">
			<div id="profile-photo">
			<?php
				$picture = $userInfo['ProfilePicture'];
				if( $picture == null )
					$picture = "no-user-image.jpg";
				echo "<img src='images/$picture' alt='profilePic' height='75' width='75'>";
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
				?> 
				</p>
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
						<p align="right">0</p>
					</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="dashboard Curved_Edges Default_Info_Box" id="main">
		<div class="tabcontent" id="favourites">
		</div>
			
		<div class="tabcontent" id="reviews">
		<?php
			foreach($userReviews as $review) {
				$restaurant_name = getRestaurantName($review['Restaurant_ID']);
				$review_date = $review['DateReview'];
				$review_score = $review['Score'];

				// TEM DE SER ALTERADO
				$review_text = "Oi";
				include ('templates/profile_review.php');
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

<?php
	include('Database/user.php');
	include('Database/restaurant.php');

	$username = $_GET['username'];
	$userInfo = getUserInfoPhp($username);
	$userRestaurants = getUserRestaurants($username);
?>

<div class="profile_content">
	<div class="dashboard" id="left-dashboard">
		<div class="Curved_Edges Default_Info_Box">
			<div id="profile-photo">
				<img src="images/default_profile_picture.png" alt="profilePic" height="75" width="75">
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
					<li>
						<p align="right">Restaurants</p>
						<p align="right">
						<?php
							echo count($userRestaurants);
						?>
						</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="dashboard Curved_Edges Default_Info_Box" id="main">
	<?php			
		include ('templates/listOwnerRestaurants.php');
	?>
	</div>
</div>

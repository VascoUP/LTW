<div id="HeaderButtons">
	<?php 
		if(!isset($_SESSION['username'])) {
	?>
			<img id="HeaderRegister" class="HeaderButton" src="images/ResgisterIcon.png" onclick="registerButton()">

			<img id="HeaderLogin" class="HeaderButton" src="images/LoginIcon.png" onclick="loginButton()">
	<?php
		} else {
	?>
		<?php
			$currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$pageLength = strlen(substr($currentURL, strripos($currentURL, "/") + 1)) - strlen(substr($currentURL, strripos($currentURL, ".")));
			$pageType = substr($currentURL, strripos($currentURL, "/") + 1, $pageLength);
			if($pageType == 'restaurant') {
				$restaurantID = substr($currentURL, strripos($currentURL, "?") + 4, 1);
				if(isRestaurantOwner($restaurantID)) {
		?>
					<img src="images/edit.png" class="HeaderButton" id="EditRestaurant" onclick="editRestaurant()"/>
		<?php } } else if($pageType == "ownerprofile" || $pageType == "userprofile") {
					$username = substr($currentURL, strripos($currentURL, "?") + 10);
					if($_SESSION['username'] == $username) {
						if(isUserOwner($username)) {
		?>
					<img id="AddRestaurant" src="images/add-restaurant.png" class="HeaderButton" onclick="addRestaurant()" />
		<?php } ?>

					<img id="EditProfile" src="images/edit.png" class="HeaderButton" onclick="editProfile()" />


		<?php } } ?>

		<img src=<?=$url?> id="UserProfileHeader" class="HeaderButton" onclick="showScrollDown()"/>
	<?php
		}
	?>

	<img id="HeaderOptions" src="images/MainIcon.png" onclick="toggleButtons()">
</div>

<div id="HeaderButtons">
	<?php 
		if(!isset($_SESSION['username'])) {
	?>
			<img id="HeaderRegister" src="images/ResgisterIcon.png" onclick="registerButton()">

			<img id="HeaderLogin" src="images/LoginIcon.png" onclick="loginButton()">

			<img id="HeaderOptions" src="images/MainIcon.png" onclick="toggleButtons()">
	<?php
		} else {
	?>
		<img src=<?=$url?> id="UserProfileHeader" onclick="showScrollDown()"/>'
	<?php 
		}
	?>
</div>
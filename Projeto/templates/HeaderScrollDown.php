<div hidden id="ProfileScrollDown">
	<ul>
		<?php 
			if(isset($_SESSION["username"])) {
				$username = $_SESSION["username"];
				echo "<a id='ScrollOptionsButton' href='profile.php?username=$username'>Your Profile</a>";
						//value='Your Profile' action='user.php?username=$username'>";

				$stmtType = $conn->prepare('SELECT * FROM Owner WHERE username = ?');
				$stmtType->execute(array($_SESSION['username']));

				$userType = $stmtType->fetch();

				if($userType) {
					echo '<input id="ScrollOptionsButton" type="submit" value="Your Restaurants" onclick="">';
				}

				echo '<form method="POST" action="action_logout.php">';
				echo '<input id="ScrollOptionsButton" type="submit" value="Logout">';
				echo '</form>';
			}
		?>
	</ul>

</div>

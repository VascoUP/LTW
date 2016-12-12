<div hidden id="ProfileScrollDown">
	<ul>
		<?php 
			if(isset($_SESSION["username"])) {
				echo '<input id="ProfileButton" type="submit" value="Your Profile" onclick="">';

				$stmtType = $conn->prepare('SELECT * FROM Owner WHERE username = ?');
				$stmtType->execute(array($_SESSION['username']));

				$userType = $stmtType->fetch();

				if($userType) {
					echo '<input id="ProfileButton" type="submit" value="Your Restaurants" onclick="">';
				}

				echo '<form method="POST" action="action_logout.php">';
				echo '<input id="ProfileButton" type="submit" value="Logout">';
				echo '</form>';
			}
		?>
	</ul>

</div>
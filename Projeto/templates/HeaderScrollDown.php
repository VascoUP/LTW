<div hidden id="ProfileScrollDown">
	<ul>
		<?php 
			if(isset($_SESSION["username"])) {
				$username = $_SESSION["username"];
				echo "<a id='ScrollOptionsButton' href='profile.php?username=$username'>Your Profile</a>";

				$stmtType = $conn->prepare('SELECT * FROM Owner WHERE username = ?');
				$stmtType->execute(array($_SESSION['username']));

				$userType = $stmtType->fetch();

				echo '<form method="POST" action="action_logout.php">';
				echo '<input id="ScrollOptionsButton" type="submit" value="Logout">';
				echo '</form>';
			}
		?>
	</ul>

</div>

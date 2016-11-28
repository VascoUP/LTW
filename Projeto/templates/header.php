		<script type="text/javascript" src="scripts/headerButtons.js"></script>	
	</head>
	<body>
		<header>
			<img src="images/logo.png" alt="AELIUS"/>
			<ul id="log_site">
				<?php
					if (isset($_SESSION['username'])) {
						echo '<li>';
							include ('templates/logout.php');
						echo '</li>';
					}
					else {
						echo '<li>';
							include ('templates/login.php');
						echo '</li>';
						echo '<li>';
							include ('templates/register.php');
						echo '</li>';
					}
				?>
			</ul>    
		</header>

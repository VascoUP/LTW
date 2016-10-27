<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<title>CSS Exercise</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style1.css">
		</head>
	<body>
  	<div id="header">
			<h1>Online Newspaper</h1>
			<h2>CSS Exercise</h2>
		</div>
		<div id="menu">
			<ul>
				<li><a href="">Politics</a></li>
				<li><a href="">Sports</a></li>
				<li><a href="">World</a></li>
				<li><a href="">Education</a></li>
				<li><a href="">Society</a></li>
			</ul>
		</div>
		<div id="content">
      <?php
				include_once('database/connection.php');
				include_once('database/news.php');

				$result = getAllNews();
      ?>
    </div>
		<div id="footer">
			<p>CSS Exercises @ FEUP - 2013</p>
		</div>
	</body>
</html>
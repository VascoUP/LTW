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

        $stmt = $db->prepare('SELECT * FROM news');
        $stmt->execute();  
        $result = $stmt->fetchAll();

        foreach( $result as $row) {
          echo '<div class="news-item">';
          echo '<h3>' . $row['title'] . '</h3>';
          echo '<p class="introduction">' . $row['introduction'] . '</p>';
          echo '<p>' . $row['fulltext'] . '</p>';
          echo 	'<ul>
					            <li><a href="https://web.fe.up.pt/%7Earestivo/page/files/exercises/css/noticia1.html">see more</a></li>
					            <li><a href="https://web.fe.up.pt/%7Earestivo/page/files/exercises/css/comentarios1.html">comments (2)</a></li>
					            <li><a href="https://web.fe.up.pt/%7Earestivo/page/files/exercises/css/partilhar1.html">share</a></li>
				        </ul>';
					echo '</div>';
        }
      ?>
    </div>
		<div id="footer">
			<p>CSS Exercises @ FEUP - 2013</p>
		</div>
	</body>
</html>
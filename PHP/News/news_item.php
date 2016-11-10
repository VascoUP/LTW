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

				try {
					$stmt = $db->prepare('SELECT * FROM news WHERE id = ?');
					$stmt->execute(array($_GET['id']));
					$result = $stmt->fetch();

					$stmtcomments = $db->prepare('SELECT * FROM comments WHERE news_id = ?');
					$stmtcomments->execute(array($_GET['id']));
					$resultcomments = $stmtcomments->fetchAll();
					
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
				echo '<div class="news-item">';
					echo '<h3>' . $result['title'] . '</h3>';
					echo '<p class="introduction">' . $result['introduction'] . '</p>';
					echo '<p>' . $result['fulltext'] . '</p>';
					echo '<div class="comments">';
					echo '<h4> Comments </h4>';
					foreach($resultcomments as $line) {
						echo '<p class="Author"><b>' . $line['author'] . ':</b> </p>';
						echo '<p class="comments">' . $line['text'] . '</p>';
					}
					echo '</div>';
					echo '<a href="list_news.php"> Back </a>';
				echo '</div>';
      ?>
    </div>
		<div id="footer">
			<p>CSS Exercises @ FEUP - 2013</p>
		</div>
	</body>
</html>

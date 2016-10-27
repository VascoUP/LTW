<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<title>CSS Exercise</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="news_ficheiros/style1.css">
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
        $db = new PDO('sqlite:news.db');

        $stmt = $db->prepare('SELECT * FROM news WHERE id = ?');
        $stmt->execute(array($_GET['id']));
        $result = $stmt->fetch();

				$stmtcomments = $db->prepare('SELECT * FROM comments WHERE news_id = ?');
        $stmtcomments->execute(array($_GET['id']));
        $resultcomments = $stmtcomments->fetch();

        foreach($result as $row) {
          echo '<div class="news-item">';
          echo '<h3>' . $row['title'] . '</h3>';
          echo '<p class="introduction">' . $row['introduction'] . '</p>';
          echo '<p>' . $row['fulltext'] . '</p>';
          foreach($resultcomments as $row) {
						echo '<div class="comments">';
						echo '<h4> Comments </h4>';
						echo '<p class="comments">' . $row['text'] . '</p>';
						echo '<p class="Author"> Commented by: ' . $row['author'] . '</p>';
						echo '</div>';
					}
		    	echo '</div>';
        }
      ?>
    </div>
		<div id="footer">
			<p>CSS Exercises @ FEUP - 2013</p>
		</div>
	</body>
</html>
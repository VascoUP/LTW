<?php
    function getAllNews() {
        global $db;
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

        return $result;
    }
?>
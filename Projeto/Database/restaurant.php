<?php

	if(isset($_POST['action']) && function_exists($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'insertReviews':
				$score = $_POST['score'];
				$content = $_POST['content'];
				$restaurantID = $_POST['restaurantID'];
				return $action($score, $content, $restaurantID);
			case 'insertReply':
				$reviewID = $_POST['reviewID'];
				$content = $_POST['content'];
				return $action($reviewID, $content);
			case 'getRestaurantProfilePicture':
				$restaurantID = $_POST['restaurantID'];
				return $action($restaurantID);
			default:
				break;
		}
	}

	function getRestaurantName($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT Name FROM Restaurant WHERE ID = ? LIMIT 1');
		$stmt->execute(array($restaurantID));

		return $stmt->fetch();
	}

	function getRestaurantInfo($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Restaurant WHERE ID = ? LIMIT 1');
		$stmt->execute(array($restaurantID));

		return $stmt->fetch();
	}

	function getRestaurantsByName($string) {
		global $conn;

		$search = '%'.$string.'%';

		$stmt = $conn->prepare("SELECT * FROM Restaurant WHERE Name LIKE ?");
		$stmt->execute(array($search));

		return $stmt->fetchAll();
	}

	function getRestaurantsByCategory($string) {
		global $conn;

		$search = '%'.$string.'%';

		$stmt = $conn->prepare("SELECT DISTINCT Restaurant.ID, Restaurant.Name, Restaurant.NScores, Restaurant.TotalScores, Restaurant.Address_ID FROM Restaurant, Category, RestaurantCategory WHERE RestaurantCategory.Restaurant_ID = Restaurant.ID AND RestaurantCategory.Category_ID = Category.ID and Category.Category LIKE ?");
		$stmt->execute(array($search));

		return $stmt->fetchAll();
	}

	function getAddress($ID) {
		global $conn;

		$stmt = $conn->prepare("SELECT * FROM Address WHERE ID = ? LIMIT 1");
		$stmt->execute(array($ID));

		return $stmt->fetch();
	}

	function getRestaurantCategories($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM RestaurantCategory Where Restaurant_ID = ? ');
    	$stmt->execute(array($restaurantID));

		return $stmt->fetchAll();
	}

	function getCategory($ID) {
		global $conn;

		$stmt = $conn->prepare("SELECT Category FROM Category WHERE ID = ? LIMIT 1");
		$stmt->execute(array($ID));

		return $stmt->fetch();
	}

	function getRestaurantOpenHours($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM RestaurantOpenHours WHERE Restaurant_ID = ?');
		$stmt->execute(array($restaurantID));

		return $stmt->fetchAll();
	}

	function getOpenHour($ID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM OpenHour WHERE ID = ? LIMIT 1');
		$stmt->execute(array($ID));

		return $stmt->fetch();
	}

	function getMenus($ID) {
		global $conn;

		$stmt = $conn->prepare('SELECT Menu.Food, Menu.Price, Category.Category FROM Restaurant, Menu, Category, MenuRestaurant WHERE Restaurant.ID = ? and MenuRestaurant.Restaurant_ID = Restaurant.ID and MenuRestaurant.Menu_ID = Menu.ID and Menu.Category_ID = Category.ID order by lower(Category.Category)');
		$stmt->execute(array($ID));

		return $stmt->fetchAll();
	}

	function getRestaurantThumbnailPictures($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Picture WHERE Restaurant_ID = ?');
		$stmt->execute(array($restaurantID));

		return $stmt->fetchAll();
	}

	function getRestaurantProfilePicture($restaurantID) {
		require_once('connection.php');

		$stmt = $conn->prepare('SELECT * FROM Picture WHERE Restaurant_ID = ? LIMIT 1');
		$stmt->execute(array($restaurantID));

		echo json_encode($stmt->fetch());
	}	

	function getRestaurantThumbnailPicture($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Picture WHERE Restaurant_ID = ? LIMIT 1');
		$stmt->execute(array($restaurantID));

		return $stmt->fetch();
	}

	function getRestaurantReviews($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Review WHERE Restaurant_ID = ?');
		$stmt->execute(array($restaurantID));

		return $stmt->fetchAll();
	}

	function getReplys($reviewID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Reply WHERE Review_ID = ?');
		$stmt->execute(array($reviewID));

		return $stmt->fetchAll();
	}

	function insertReviews($score, $content, $restaurantID) {
		require_once('connection.php');
		$answer = array();

		$currentDate = getdate();
		$insertDate = $currentDate['year']."-".$currentDate['mon']."-".$currentDate['mday'];
		$username = $_SESSION['username'];

		$stmt = $conn->prepare('INSERT INTO Review (ID, Username, Content, Score, DateReview, Restaurant_ID) VALUES (NULL, ?, ?, ?, ?, ?)');
		$stmt->execute(array($username, $content, $score, $insertDate, $restaurantID));

		$answer['Date'] = $insertDate;
		$answer['username'] = $username;

		echo json_encode($answer);
	}

	function insertReply($reviewID, $content) {
		require_once('connection.php');
		$answer = array();

		$currentDate = getdate();
		$insertDate = $currentDate['year']."-".$currentDate['mon']."-".$currentDate['mday'];
		$username = $_SESSION['username'];

		$stmt = $conn->prepare('INSERT INTO Reply (Username, Review_ID, Content, CommentDate) VALUES (?, ?, ?, ?)');
		$stmt->execute(array($username, $reviewID, $content, $insertDate,));

		$answer['Date'] = $insertDate;
		$answer['username'] = $username;

		echo json_encode($answer);
	}

	function isRestaurantOwner($restaurantID) {
		global $conn;

		$username = $_SESSION['username'];
		$stmt = $conn->prepare('SELECT * FROM Restaurant WHERE ID = ? AND Owner_Username = ? LIMIT 1');
		$stmt->execute(array($restaurantID, $username));

		return $stmt->fetch();
	}

?>

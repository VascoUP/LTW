<?php 

	if(isset($_POST['action']) && function_exists($_POST['action'])) {
		$action = $_POST['action'];
		$restaurant = $_POST['restaurant'];
		return $action($restaurant);
	} 

	function getRestaurantInfo($restaurant) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Restaurant WHERE Name = ? LIMIT 1');
		$stmt->execute(array($restaurant));

		$result = $stmt->fetch();

		echo json_encode($result);
	}

	function getSearchRestaurants($string) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Restaurant WHERE Name LIKE \'%?%\'');
		$stmt->execute(array($string));

		$result = $stmt->fetchAll();

		echo json_encode($result);
	}

?>
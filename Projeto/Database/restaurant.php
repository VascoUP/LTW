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

		$search = '%'.$string.'%';

		$stmt = $conn->prepare("SELECT * FROM Restaurant WHERE Name LIKE ?");
		$stmt->execute(array($search));

		return $stmt->fetchAll();
	}

	function getAddress($ID) {
		global $conn;

		$stmt = $conn->prepare("SELECT StreetName FROM Address WHERE ID = ? LIMIT 1");
		$stmt->execute(array($ID));

		return $stmt->fetch();
	}

?>
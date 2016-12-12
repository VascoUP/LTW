<?php

	if(isset($_POST['action']) && function_exists($_POST['action'])) {
		$action = $_POST['action'];
		$restaurant = $_POST['restaurant'];
		return $action($restaurant);
	} 

	function getRestaurantInfo($restaurantID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM Restaurant WHERE ID = ? LIMIT 1');
		$stmt->execute(array($restaurantID));

		return $stmt->fetch();
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

?>
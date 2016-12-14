<<<<<<< HEAD
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

?>
=======
<?php

	if(isset($_POST['action']) && function_exists($_POST['action'])) {
		$action = $_POST['action'];
		$restaurant = $_POST['restaurant'];
		return $action($restaurant);
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

?>
>>>>>>> 59cc73e2f3b0a7fdfb3e5650e4b5497612e3093a

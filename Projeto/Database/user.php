<?php

  if(isset($_POST['action']) && function_exists($_POST['action'])) {
    $action = $_POST['action'];
    $username = $_POST['username'];

    switch($action) {

      case 'verifyUser':
        $password = $_POST['password'];
        return $action($username, $password);
      case 'removeFavorite':
      case 'insertFavorite':
        $restaurantID = $_POST['restaurantID'];
        return $action($restaurantID);
      default:
        return $action($username);
    }
  }

  function createUser($username, $firstname, $lastname, $email, $password, $usertype, $profilepicture) {
    global $conn;

    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO User (Username, FirstName, LastName, Email, Password, ProfilePicture) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($username, $firstname, $lastname, $email, $hash, $profilepicture));

    if($usertype == 'reviewer')
      $stmt2 = $conn->prepare('INSERT INTO Reviewer (Username) VALUES (?)');
    else
      $stmt2 = $conn->prepare('INSERT INTO Owner (Username) VALUES (?)');

    $stmt2->execute(array($username));

  }

  function verifyUser($username, $password) {
    require_once('connection.php');
    $answer = array();

    $stmt = $conn->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
    $stmt->execute(array($username));
    $user = $stmt->fetch();

    if($user !== false && password_verify($password, $user['Password']))
      $answer['success'] = true;
    else
      $answer['success'] = false;

    echo json_encode($answer);
  }

  function verifyUserPhp($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
    $stmt->execute(array($username));
    $user = $stmt->fetch();

    return ($user !== false && password_verify($password, $user['Password']));
  }

  function isUserTaken($username) {
    require_once('connection.php');

    $stmt = $conn->prepare('SELECT * FROM User WHERE Username = ? LIMIT 1');
    $stmt->execute(array($username));

    $results = $stmt->fetch();

    if(!$results)
      echo 'This username is available.';
    else
      echo 'This username is taken.';
  }

  function getProfilePicture($username) {
    require_once('connection.php');

    $stmt = $conn->prepare('SELECT ProfilePicture FROM User WHERE username = ? LIMIT 1');
    $stmt->execute(array($username));

    $result = $stmt->fetch();

    echo json_encode($result);
  }

  function getUserInfo($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
    $stmt->execute(array($username));

    $result = $stmt->fetch();

    echo json_encode($result);
  }

  function getUserInfoPhp($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
    $stmt->execute(array($username));
    
    return $stmt->fetch();
  }

  function isUserOwner($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM Owner WHERE Username = ? LIMIT 1');
    $stmt->execute(array($username));

    return $stmt->fetch();
  }

  function isUserReviewer($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM Reviewer WHERE Username = ? LIMIT 1');
    $stmt->execute(array($username));

    return $stmt->fetch();
  }

  function getUserReviews($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM Review WHERE username = ?');
    $stmt->execute(array($username));

    return $stmt->fetchAll();
  }


  function getUserFavourites($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM Favourite WHERE Username = ?');
    $stmt->execute(array($username));

    return $stmt->fetchAll();
  }

  function getUserRestaurants($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT  * FROM Restaurant WHERE Owner_Username = ?');
    $stmt->execute(array($username));

    return $stmt->fetchAll();
  }

  function isFavorite($restaurantID) {
    global $conn;

    $username = $_SESSION['username'];
    $stmt = $conn->prepare('SELECT  * FROM Favourite WHERE Restaurant_ID = ? AND Username = ? LIMIT 1');
    $stmt->execute(array($restaurantID, $username));

    return $stmt->fetch();
  }

  function insertFavorite($restaurantID) {
    require_once('connection.php');

    $username = $_SESSION['username'];
    $stmt = $conn->prepare('INSERT INTO Favourite (Restaurant_ID, Username) VALUES (?, ?)');
    $stmt->execute(array($restaurantID, $username));
  }

  function removeFavorite($restaurantID) {
		require_once('connection.php');

    $username = $_SESSION['username'];
    $stmt = $conn->prepare('DELETE FROM Favourite WHERE Restaurant_ID = ? AND Username = ?');
    $stmt->execute(array($restaurantID, $username));
	}

  function updateUsername($username) {
    if( $username != $_SESSION['username'] || $username == "" )
      return ;

    global $conn;

    $oldUsername = $_SESSION['username'];

    $stmt = $conn->prepare('UPDATE User SET Username = $username WHERE Username = $oldUsername');
    $stmt->execute();

    if( isUserOwner($oldUsername) ) {
      $stmt = $conn->prepare('UPDATE Owner SET Username = $username WHERE Username = $oldUsername');
      $stmt->execute();
    } else {
      $stmt = $conn->prepare('UPDATE Reviewer SET Username = $username WHERE Username = $oldUsername');
      $stmt->execute();
    }

    $_SESSION['username'] = $username;
  }

  function updateFirstName($firstName) {
    $username = $_SESSION['username'];
    $info = getUserInfoPhp($username);

    if( $info['FirstName'] == $firstName || $firstName == "" )
      return ;

    global $conn;

    $stmt = $conn->prepare('UPDATE User SET FirstName = $firstName WHERE Username = $username');
    $stmt->execute();
  }

  function updateLastName($lastName) {
    $username = $_SESSION['username'];
    $info = getUserInfoPhp($username);

    if( $info['LastName'] == $lastName || $lastName == "" )
      return ;

    global $conn;

    $stmt = $conn->prepare('UPDATE User SET LastName = $lastName WHERE Username = $username');
    $stmt->execute();
  }

  function updateEmail($email) {
    $username = $_SESSION['username'];
    $info = getUserInfoPhp($username);

    if( $info['Email'] == $email || $email == "" )
      return ;

    global $conn;

    $stmt = $conn->prepare('UPDATE User SET Email = $email WHERE Username = $username');
    $stmt->execute();
  }

  function updatePassword($oldPass, $newPass, $confPass) {
    if( $oldPass == "" || $newPass == "" || $confPass == "" || $newPass != $confPass )
      return ;

    $username = $_SESSION['username'];
    verifyUserPhp($username, $oldPass);

    $options = ['cost' => 12];
    $hash = password_hash($newPass, PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('UPDATE User SET Password = $hash WHERE Username = $username');
    $stmt->execute();
  }
?>

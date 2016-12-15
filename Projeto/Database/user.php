<?php
  if(isset($_POST['action']) && function_exists($_POST['action'])) {
    $action = $_POST['action'];
    echo $action;
    switch($action) {

      case 'verifyUser':
        $username = $_POST['username'];
        $password = $_POST['password'];
        return $action($username, $password);
      case 'removeFavorite':
      case 'insertFavorite':
        $restaurantID = $_POST['restaurantID'];
        return $action($restaurantID);
      case 'updateProfile':
        $image = $_POST['regProfilePic'];
        $username = trim(strip_tags($_POST['username']));
        $password = $_POST['password'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];

        return $action($image, $username, $firstName, $lastName, $email, $password);
        case 'validateCurrentUser':
          $password = $_POST['password'];
          return $action($password);
      default:
        $username = $_POST['username'];
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


  function validateCurrentUser($password) {
    require_once('connection.php');

    $username = $_SESSION['username'];
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

  function isUserTaken($username) {
    require_once('connection.php');
    echo "Linked in isUserTaken";

    if(isset($_SESSION['username']) && $username == $_SESSION['username']) {
      echo 'This username is available.';
      return;
    }

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
    require_once('connection.php');
    if( $username == $_SESSION['username'] || $username == "" )
      return ;

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

    if( $firstName == "" )
      return ;

    $stmt = $conn->prepare('UPDATE User SET FirstName = $firstName WHERE Username = $username');
    $stmt->execute();
  }

  function updateLastName($lastName) {
    require_once('connection.php');
    $username = $_SESSION['username'];

    if( $lastName == "" )
      return ;

    $stmt = $conn->prepare('UPDATE User SET LastName = $lastName WHERE Username = $username');
    $stmt->execute();
  }

  function updateEmail($email) {
    require_once('connection.php');
    $username = $_SESSION['username'];

    if( $email == "" )
      return ;

    $stmt = $conn->prepare('UPDATE User SET Email = $email WHERE Username = $username');
    $stmt->execute();
  }

  function updatePassword($password) {
    require_once('connection.php');
    if($password == "")
      return ;

    $options = ['cost' => 12];
    $hash = password_hash($newPass, PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('UPDATE User SET Password = $hash WHERE Username = $username');
    $stmt->execute();
  }

  function updateProfilePicture($image) {
    require_once('connection.php');

    $username = $_SESSION['username'];
    $stmt = $conn->prepare('UPDATE User SET ProfilePicture = $image WHERE Username = $username');
    $stmt->execute();
  }

  function updateProfile($image, $username, $firstName, $lastName, $email, $password) {
    echo "updateProfile";
    require_once('connection.php');

    if($conn)
      echo "Linked in updateProfile!";

    $extension = "";
    if (isset($image)) {
      $profilePicName = $_FILES['regProfilePic']['name'];
      $profilePicTempName = $_FILES['regProfilePic']['tmp_name'];

      if(isset($profilePicName)) {
        if(!empty($profilePicName)) {
          $extension .= strtolower(substr($profilePicName, strpos($profilePicName, '.')));
          $fileName = "Database/ProfilePictures/Originals/$username$extension";
          $thumbnailName = "Database/ProfilePictures/Thumbnail/$username$extension";

          move_uploaded_file($profilePicTempName, $fileName);

          if($extension == '.png')
            $originalImage = imagecreatefrompng($fileName);
          else 
            $originalImage = imagecreatefromjpeg($fileName);
          $width = imagesx($originalImage);
            $height = imagesy($originalImage);
            $square = min($width, $height);

            //Create 200x200 thumbnail
          $thumbnail = imagecreatetruecolor(200, 200); 
          imagecopyresized($thumbnail, $originalImage, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);

          if($extension == '.png')
            imagepng($thumbnail, $thumbnailName);
          else
            imagejpeg($thumbnail, $thumbnailName);
        }
      }
      updateProfilePicture("$username$extension");
    }

    echo "$extension";
    updateFirstName($firstName);
    updateLastName($lastName);
    updateEmail($email);
    updatePassword($password);
    updateUsername($username);

    header("Location: profile.php?username=$username");
  }
?>
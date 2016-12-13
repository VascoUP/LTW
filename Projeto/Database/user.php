<?php 

  if(isset($_POST['action']) && function_exists($_POST['action'])) {
    $action = $_POST['action'];
    $username = $_POST['username'];

    switch($action) {

      case 'verifyUser': 
        $password = $_POST['password'];
        return $action($username, $password);

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

  function isUserOwner($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM Owner WHERE username = ?');
    $stmt->execute(array($username));

    $result = $stmt->fetch();

    return json_encode($result); 
  }

?>

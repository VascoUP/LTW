<?php 

  if(isset($_POST['action']) && function_exists($_POST['action'])) {
    $action = $_POST['action'];
    $username = $_POST['username'];
    return $action($username);
  } 

  function createUser($username, $firstname, $lastname, $email, $password, $usertype) {
    global $conn;  
      
    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO User (Username, FirstName, LastName, Email, Password, Profile_picture) 
                              VALUES (?, ?, ?, ?, ?, 0)');
    $stmt->execute(array($username, $firstname, $lastname, $email, $hash));

    echo $userType;

    if($userType == 'reviewer')
      $stmt2 = $conn->prepare('INSERT INTO Reviewer (Username) VALUES (?)');
    else 
      $stmt2 = $conn->prepare('INSERT INTO Owner (Username) VALUES (?)');

    $stmt2->execute(array($username));

  }

  function verifyUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM User WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    return ($user !== false && password_verify($password, $user['password']));
  }

  function isUserTaken($username) {    
    $conn = new PDO('sqlite:Database.db');
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT * FROM User WHERE Username =? LIMIT 1');
    $stmt->execute(array($username));

    $results = $stmt->fetch();

    if(!$results)
      echo 'This username is available.';
    else 
      echo 'This username is taken.';
  }

?>
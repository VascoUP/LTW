<?php
  include_once('config/init.php');
  include_once('Database/user.php');
  
  $username = trim(strip_tags($_POST['username']));
  $password = $_POST['password'];  

  if (verifyUser($username, $password)) {
  	echo 'Set.';
    $_SESSION['username'] = $username;
  }
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

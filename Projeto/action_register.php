<?php
  include_once('config/init.php');
  /*include_once('database/user.php');
  
  $username = trim(strip_tags($_POST['username']));
  $password = sha1($_POST['password']);  

  createUser($username, $password);*/
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

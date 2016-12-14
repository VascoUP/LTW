<?php
  include_once('config/init.php');
  
  $username = trim(strip_tags($_POST['username']));
  $password = $_POST['password'];  

  $_SESSION['username'] = $username;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  
?>

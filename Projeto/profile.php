<?php
	include_once('config/init.php');  
	include ('Database/user.php');

	$username = $_GET['username'];
	$isOwner = isUserOwner($username);

	if($isOwner)
  		header ("Location: ownerprofile.php?username=$username");
	else
  		header ("Location: userprofile.php?username=$username");
?>

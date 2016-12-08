<?php
	include_once('config/init.php');
	include_once('Database/user.php');

	$username = trim(strip_tags($_POST['username']));
	$password = $_POST['password'];
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$userType = $_POST['userType'];

	createUser($username, $firstName, $lastName, $email, $password, $userType);

	header('Location: restaurant.php');
?>

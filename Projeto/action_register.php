<?php
	include_once('config/init.php');
	include_once('Database/user.php');

	$username = trim(strip_tags($_POST['username']));
	$password = $_POST['password'];
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$userType = $_POST['userType'];

	if (isset($_FILES['regProfilePic'])) {
		$profilePicName = $_FILES['regProfilePic']['name'];
		$profilePicTempName = $_FILES['regProfilePic']['tmp_name'];

		if(isset($profilePicName)) {
			if(!empty($profilePicName)) {
				$extension = strtolower(substr($profilePicName, strpos($profilePicName, '.')));
				$name = $username.$extension;
				move_uploaded_file($profilePicTempName, 'Database/ProfilePictures/'.$name);
			}
		}
		createUser($username, $firstName, $lastName, $email, $password,$userType, $name);
	} else 
		createUser($username, $firstName, $lastName, $email, $password,$userType, "NULL");



	header('Location: initial.php');
?>

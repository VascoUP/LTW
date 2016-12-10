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

	if (isset($_FILES['regProfilePic'])) {
		$profilePicName = $_FILES['regProfilePic']['name'];
		$profilePicTempName = $_FILES['regProfilePic']['temp_name'];

		if(isset($profilePicName)) {
			if(!empty($profilePicName)) {
				echo 'here';
				$extension = strtolower(substr($profilePicName, strpos($profilePicName, '.')));
				$name = $username.$extension;
				move_uploaded_file($profilePicTempName, 'Database/ProfilePictures/'.$name);
			}
		}
	} else
		echo 'Not set.'

	header('Location: restaurant.php');
?>

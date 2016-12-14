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
		createUser($username, $firstName, $lastName, $email, $password, $userType, $fileName);
	} else 
		createUser($username, $firstName, $lastName, $email, $password, $userType, "NULL");



	header('Location: initial.php');
?>

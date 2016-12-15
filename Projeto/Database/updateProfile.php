<?php
	include_once('connection.php');
	include_once('user.php');

	function updateUsername($username) {
		if( $username == $_SESSION['username'] || $username == "" )
		  return ;

		global $conn;

		$oldUsername = $_SESSION['username'];

		$stmt = $conn->prepare('UPDATE User SET Username = ? WHERE Username = ?');
		$stmt->execute(array($username, $oldUsername));

		if( isUserOwner($oldUsername) ) {
		  $stmt = $conn->prepare('UPDATE Owner SET Username = ? WHERE Username = ?');
		  $stmt->execute(array($username, $oldUsername));
		} else {
		  $stmt = $conn->prepare('UPDATE Reviewer SET Username = ? WHERE Username = ?');
		  $stmt->execute(array($username, $oldUsername));
		}

		$_SESSION['username'] = $username;
	}

	function updateFirstName($firstName) {
		$username = $_SESSION['username'];

		if( $firstName == "" )
		  return ;

		global $conn;
		echo $firstName;
		echo $username;

		$stmt = $conn->prepare('UPDATE User SET FirstName = ? WHERE Username = ?');
		$stmt->execute(array($firstName, $username));
	}

	function updateLastName($lastName) {
		$username = $_SESSION['username'];

		if( $lastName == "" )
		  return ;

		global $conn;

		$stmt = $conn->prepare('UPDATE User SET LastName = ? WHERE Username = ?');
		$stmt->execute(array($lastName, $username));
	}

	function updateEmail($email) {
		$username = $_SESSION['username'];

		if( $email == "" )
		  return ;

		global $conn;

		$stmt = $conn->prepare('UPDATE User SET Email = ? WHERE Username = ?');
		$stmt->execute(array($email, $username));
	}

	function updatePassword($password) {
		if($password == "")
		  return ;

		global $conn;

		$options = ['cost' => 12];
		$hash = password_hash($newPass, PASSWORD_DEFAULT, $options);

		$stmt = $conn->prepare('UPDATE User SET Password = ? WHERE Username = ?');
		$stmt->execute(array($hash, $username));
	}

	function updateProfilePicture($image) {
		global $conn;

		$username = $_SESSION['username'];
		$stmt = $conn->prepare('UPDATE User SET ProfilePicture = ? WHERE Username = ?');
		$stmt->execute(array($image, $username));
	}

    $username = trim(strip_tags($_POST['username']));
    $password = $_POST['password'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];

    $extension = "";
    if (isset($_FILES['regProfilePic'])) {
      $profilePicName = $_FILES['regProfilePic']['name'];
      $profilePicTempName = $_FILES['regProfilePic']['tmp_name'];

      if(isset($profilePicName)) {
        if(!empty($profilePicName)) {
          $extension .= strtolower(substr($profilePicName, strpos($profilePicName, '.')));
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
      updateProfilePicture("$username$extension");
	}

    updateFirstName($firstName);
    updateLastName($lastName);
    updateEmail($email);
    updatePassword($password);
    updateUsername($username);

    header("Location: ../profile.php?username=$username");

?>
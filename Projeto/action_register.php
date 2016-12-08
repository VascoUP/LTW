<?php
	include_once('config/init.php');

	$username = trim(strip_tags($_POST['username']));
	$password = sha1($_POST['password']);
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$userType = $_POST['userType'];

	try {
		$stmt2 = $dbh->prepare('INSERT INTO User (User_name, FirstName, LastName, Email, Password) 
									VALUES (?,?,?,?,?)');
		//$stmt->execute(array($username, $firstname, $lastname, $email, $password));
	} catch(PDOException $e) {
		echo e->getMessage();
	}

	echo $username.'<br>'.$password.'<br>'.$firstName.'<br>'.$lastName.'<br>'.$email.'<br>'.$userType;

	//header('Location: restaurant.php']);
?>

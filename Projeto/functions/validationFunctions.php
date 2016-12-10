<?php

	if(isset($_POST['action']) && function_exists($_POST['action'])) {

		$action = $_POST['action'];

		switch($action) {
			case 'validateEmail':
				$email = $_POST['email'];
				return $action($email);
			case 'validateUsername':
				$username = $_POST['username'];
				return $action($username);
			case 'validateName':
				$name = $_POST['name'];
				return $action($name);
			default:
				return;
		}
  	} 

	function validateEmail($email) {
		$answer = array();

		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			$answer['success'] = false;
		else
			$answer['success'] =  true;

		header('Content-Type', 'application/json');
		echo json_encode($answer);
	}

	function validateUsername($username) {
		$answer = array();

		if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
			$answer['success'] = false;
		} else
			$answer['success'] =  true;

		header('Content-Type', 'application/json');
		echo json_encode($answer);
	}

	function validateName($name) {
		$answer = array();

		if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
			$answer['success'] = false;
		} else
			$answer['success'] =  true;

		header('Content-Type', 'application/json');
		echo json_encode($answer);
	}

?>
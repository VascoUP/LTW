<?php
	session_start(); //Start a new session

	//Connection to Database
	try {
		$dbh = new PDO('sqlite:Database/Database.db');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch(PDOException $e) {
		echo $e->getMessage();
	}

	//Get necessary info
?>

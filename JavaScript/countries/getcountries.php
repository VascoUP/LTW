<?php
  $name = $_GET['name'];

  // Database connection
  $dbh = new PDO('sqlite:countries.db');
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Get the countries that start with $name
  $stmt = $dbh->prepare("SELECT * FROM countries WHERE upper(name) LIKE upper(?) LIMIT 10");
  $stmt->execute(array("$name%"));
  $countries = $stmt->fetchAll();
  
  // JSON encode them
  echo json_encode($countries);
?>

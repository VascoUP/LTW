<?php
    global $conn;
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM Restaurant Where ID='$id'");
    $stmt->execute();  
    $rst = $stmt->fetch();

    $address_id = $rst['Address_ID'];

    $stmt = $conn->prepare("SELECT * FROM Address Where ID='$address_id'");
    $stmt->execute();  
    $add = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM RestaurantCategory Where Restaurant_ID='$id'");
    $stmt->execute(); 
    $cats = $stmt->fetchAll();

    foreach($cats as $row) {
        $cat_id = $row['Category_ID'];
	echo $cat_id;
	echo '<br>';
    }
?>

<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    $customerID = $_GET['customerID'];
    $UPC = $_GET['UPC'];
    $return = removeFromWishList($dbh, $customerID, $UPC);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
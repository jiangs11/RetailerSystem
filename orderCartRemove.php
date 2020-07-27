<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    $customerID = $_GET['customerID'];
    $UPC = $_GET['UPC'];
    $order = getCurrentOrderNumber($dbh, $customerID);
    $orderID = '';
    foreach ( $order as  $number )
    {
        $orderID = $number->orderID; 
    } 

    $return = removeFromOrderCart($dbh, $orderID, $UPC);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    $customerID = $_GET['customerID'];
    $UPC = $_GET['UPC'];
    $quantity = $_GET['quantity'];

    // never made an order before
    $checkOrderExits = getCurrentOrderNumber($dbh, $customerID);
    $return1 = '';

    foreach ( $checkOrderExits as $number ) {
        $return1 = $number->orderID;
    }
    if (is_null($return1))
    {
        createOrder($dbh, $customerID);
        $getCurrentOrder = getCurrentOrderNumber($dbh, $customerID);
        $return2 = '';
    
        foreach ( $getCurrentOrder as $number ) {
            $return2 = $number->orderID;
        }
        addItemsToOrder($dbh, $return2, $UPC, $quantity);

    }
    else
    {
        addItemsToOrder($dbh, $return1, $UPC, $quantity);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
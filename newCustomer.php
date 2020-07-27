<?php

    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();

    $fname = $_GET["fname"];
    $lname = $_GET["lname"];
    $address = $_GET["address"];
    $city = $_GET["city"];
    $state = $_GET["state"];
    $zip = $_GET["zip"];

    insertNewCustomer($dbh, $fname, $lname, $address, $city, $state, $zip);

    $return = getNewCustomerID($dbh, $fname, $lname, $address, $city, $state, $zip);
    
    foreach ( $return as $number ) {
        $customerID = $number->customerID;
    }

    echo "<h1>Welcome to MyFancyRetailer!</h1>";
    echo "<h2>Your new Customer ID is: $customerID.</h2>";
    echo "<h2>Please remember this ID because you will need it to log into our system.</h2>";

    echo "<h3>To begin shopping, please click on the button below.</h3>";
    echo "<button onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Begin Shopping!</button>";
?>

<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();

    $customerID = $_GET["id"];
    $Fname = $_GET["fname"];
    $Lname = $_GET["lname"];

    $return = authenticateUser($dbh, $customerID, $Fname, $Lname);

    $counter = 0;
    foreach ( $return as $number ) {
        $counter++;
    }

    if ($counter == 1)
    {
        echo "<script type=\"text/javascript\">location.href = 'productsList.php?customerID=$customerID';</script>";
    }
    else
    {
        echo "<script type=\"text/javascript\">location.href = 'userLoginForm.html';</script>";
    }
?>
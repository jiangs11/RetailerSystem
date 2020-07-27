<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    $customerID = $_GET['customerID'];
    $UPC = $_GET['UPC'];
    $rating = $_GET['radio'];
    $ratingdate = date("Y-m-d");

    $returnCheck = getCustomerRating($dbh, $customerID, $UPC);

    $counter = 0;
    $oldRating = '';
    $oldRatingDate = '';

    foreach ( $returnCheck as $number ) {
        $counter++;
        $oldRating = $number->rating;
        $oldRatingDate = $number->ratingdate;
    }
    if ($counter == 1)
    {
        echo "<h1>You have already rated item: $UPC</h1>";
        echo "<h1>on date $oldRatingDate with a rating of $oldRating.</h1>";
        echo "<button class=\"logout2\" name=\"logout2\" style=\"font-size:25px;\" onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Back to Shopping!</button>";
    }
    else
    {
        $return = addCustomerRating($dbh, $customerID, $UPC, $rating, $ratingdate);
        echo "<h1>You gave item $UPC a rating of $rating on $ratingdate.</h1>";
        echo "<h1>Thank you for rating!</h1>";
        echo "<button class=\"logout2\" name=\"logout2\" style=\"font-size:25px;\" onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Back to Shopping!</button>";
    }
?>
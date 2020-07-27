<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="ratingPageee.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<br>

<body>
<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    $customerID = $_GET['customerID'];
    $UPC = $_GET['UPC'];

    $return = listProductInfo($dbh, $UPC);

    foreach ( $return as $number ) {
        $UPC = $number->UPC;
        $OG_Pname = $number->Pname;
        $Pname = str_replace(' ', '', $OG_Pname);
        $Pname = str_replace(':', '', $Pname);
        $Price = $number->price;
        $Amount = $number->amount;
        $Sname = $number->Sname;
    }
    echo "<div class=\"buttGroup\">";
    echo "<button class=\"logout2\" name=\"logout2\" onclick=\"window.location.href='index.html';\">Logout</button>";
    echo "<button class=\"back\" name=\"back\" onclick=\"window.location.href='productInformation.php?customerID=$customerID&UPC=$UPC';\">Back</button>";
    echo "</div>";

    echo "<h1>Make a Rating for Product:</h1>";
    echo "<h2>$OG_Pname</h2>";
    echo "<hr>";
    echo "<img src=\"assets/products_img/$Pname.jpg\" alt=\"product\" class=\"product\">";

    $return2 = avgProdRating($dbh, $UPC);
    $avgRating = '';
    $numReviews = '';

    foreach ( $return2 as $number ) {
        $avgRating = $number->avgRating;
        $numReviews = $number->numReviews;
    }
    
    $avgRating = number_format($avgRating, 2);
    $avgRating = ($avgRating / 5) * 100;

    echo "<h6>Average Rating : $avgRating%</h6>";
    echo "<h6>$numReviews review(s)</h6>";
    echo "<div class=\"star_rating\">";
        echo "<div class=\"rating-upper\" style=\"width: $avgRating%\">";
            echo "<span>★</span>";
            echo "<span>★</span>";
            echo "<span>★</span>";
            echo "<span>★</span>";
            echo "<span>★</span>";
        echo "</div>";
        echo "<div class=\"rating-lower\">";
            echo "<span>★</span>";
            echo "<span>★</span>";
            echo "<span>★</span>";
            echo "<span>★</span>";
            echo "<span>★</span>";
        echo "</div>";
    echo "</div>";

    echo "<br><br><br>";

    echo "<form action=\"ratedProduct.php\" method=\"GET\">";

    echo "<label class=\"container\">5";
    echo "<input type=\"radio\" checked=\"checked\" name=\"radio\" value=\"5\">";
    echo "<input type=\"hidden\" name=\"customerID\" value=\"$customerID\">";
    echo "<input type=\"hidden\" name=\"UPC\" value=\"$UPC\">";
    echo "<span class=\"checkmark\"></span>";
    echo "</label>";

    echo "<label class=\"container\">4";
    echo "<input type=\"radio\" name=\"radio\" value=\"4\">";
    echo "<input type=\"hidden\" name=\"customerID\" value=\"$customerID\">";
    echo "<input type=\"hidden\" name=\"UPC\" value=\"$UPC\">";
    echo "<span class=\"checkmark\"></span>";
    echo "</label>";

    echo "<label class=\"container\">3";
    echo "<input type=\"radio\" name=\"radio\" value=\"3\">";
    echo "<input type=\"hidden\" name=\"customerID\" value=\"$customerID\">";
    echo "<input type=\"hidden\" name=\"UPC\" value=\"$UPC\">";
    echo "<span class=\"checkmark\"></span>";
    echo "</label>";

    echo "<label class=\"container\">2";
    echo "<input type=\"radio\" name=\"radio\" value=\"2\">";
    echo "<input type=\"hidden\" name=\"customerID\" value=\"$customerID\">";
    echo "<input type=\"hidden\" name=\"UPC\" value=\"$UPC\">";
    echo "<span class=\"checkmark\"></span>";
    echo "</label>";

    echo "<label class=\"container\">1";
    echo "<input type=\"radio\" name=\"radio\" value=\"1\">";
    echo "<input type=\"hidden\" name=\"customerID\" value=\"$customerID\">";
    echo "<input type=\"hidden\" name=\"UPC\" value=\"$UPC\">";
    echo "<span class=\"checkmark\"></span>";
    echo "</label>";

    echo "<input type=\"submit\" value=\"Submit\" style=\"color: white; background-color: blue; font-size: 25px; font-weight: bold; width: auto; height: auto; margin-left:50%;\">";
    echo "</form>;" 
?>
</body>
</html>
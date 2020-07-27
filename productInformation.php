<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="allProductPages.css">
    <link rel="stylesheet" type="text/css" href="productsPageee.css">
    <!--<link rel="stylesheet" type="text/css" href="quantityButton.css">-->
    <!--<script src="quantityButton.js"></script>-->
</head>
<body>
<br>
<div class="buttGroup">
    <button class="logout2" name="logout2" onclick="window.location.href='index.html';">Logout</button>
    <?php    
        $customerID = $_GET["customerID"];
        echo "<button class=\"back\" name=\"back\" onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Back</button>";
    ?>
</div>
<h1>
    MyFancyRetailer Shop
</h1>
<hr>
<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();

    $customerID = $_GET["customerID"];
    $UPC = $_GET["UPC"];

    // shopping cart
    echo "<button name=\"shoppingcart\" onclick=\"window.location.href='checkout.php?customerID=$customerID';\" style=\"background-color: transparent; border-style: none\">";
    echo "<img src=\"assets/shoppingcart.png\" alt=\"shoppingcart\" class=\"shoppingcart\">";
    echo "</button>";
    // view wishlist
    echo "<button name=\"wishlist\" onclick=\"window.location.href='wishlist.php?customerID=$customerID&UPC=$UPC';\" style=\"float:right; background:cyan; margin-top:2%; margin-right:1%; color:black; height:6%;\">View WishList</button>";

    $return = listProductInfo($dbh, $UPC);

    foreach ( $return as $number ) {
        $OG_Pname = $number->Pname;
        $Pname = str_replace(' ', '', $OG_Pname);
        $Pname = str_replace(':', '', $Pname);
        $Price = $number->price;    
        $Amount = $number->amount;
        $Sname = $number->Sname;
    }

    echo "<div class=\"container\">";
    echo "<h3>$OG_Pname</h3>";
    echo "<img src=\"assets/products_img/$Pname.jpg\" alt=\"product\" class=\"product\">";
    echo "<div class=\"ProductDetails\">";
    echo "<h4>Original Price : $$Price</h4>";
    echo "<h5>In Stock : $Amount</h5>";

    // Star Rating
    $return2 = avgProdRating($dbh, $UPC);
    $avgRating = '';
    $numReviews = '';

    foreach ( $return2 as $number ) {
        $avgRating = $number->avgRating;
        $numReviews = $number->numReviews;
    }
    
    $avgRating = number_format($avgRating, 2);
    $avgRating = ($avgRating / 5) * 100;

    echo "<h6>Average Rating : $avgRating% out of $numReviews review(s)</h6>";
    echo "</div>";
    echo "<div class=\"rating\">";
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
    echo "<div class=\"review\">";
    echo "<button class=\"makeReview\" name=\"makeReview\" onclick=\"window.location.href='makeReview.php?customerID=$customerID&UPC=$UPC';\">Make a Review</button>";
    echo "</div>";

    echo "<form method=\"GET\" action=\"addItemToCart.php\">";
        echo "<div class=\"numbers-row\">";
            echo "<label for=\"name\">Quantity</label>";
            echo "<input type=\"text\" name=\"quantity\" id=\"quantity\" value=\"1\">";
        echo "</div>";

        echo "<input type=\"hidden\" name=\"customerID\" value=\"$customerID\">";
        echo "<input type=\"hidden\" name=\"UPC\" value=\"$UPC\">";
        echo "<div class=\"addCart\">";
        echo "<input type=\"submit\" value=\"Add to Cart\" id=\"submit\">";
        echo "</div>";
    echo "</form>";

    //echo "<button class=\"addCart\" name=\"addCart\" onclick=\"addItemToCart.php?UPC=$UPC\">Add to Cart</button>";
    echo "<button class=\"addCart\" name=\"addCart\" style=\"background: lightblue; height: auto;\" onclick=\"window.location.href='wishListAdd.php?customerID=$customerID&UPC=$UPC';\">Add to WishList</button>";
?>
</body>
<script>
    $(function() {
        $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');

        $(".button").on("click", function() {

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 2) {
            var newVal = parseFloat(oldValue) - 1;
            } else {
            newVal = 1;
            }
        }

        $button.parent().find("input").val(newVal);
        });
    });

</script>
</html>
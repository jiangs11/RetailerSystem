<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of all the Products</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="allProductPages.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
        .rating {
            display: inline-block;
            unicode-bidi: bidi-override;
            color: #888888;
            font-size: 35px;
            height: 40px;
            width: auto;
            margin-top: 1%;
            margin-bottom: 2%;
            margin-left: 10%;
            position: relative;
            padding: 0;         
        }

        .rating-upper {
            color: darkorchid;
            padding: 0;
            position: absolute;
            z-index: 1;
            display: flex;
            top: 0;
            left: 0;
            overflow: hidden;
        }

        .rating-lower {
            padding: 0;
            display: flex;
            z-index: 0;
        }  
    </style>
</head>
<body>
        
<br>
<button class="logout1" name="logout1" onclick="window.location.href = 'index.html';">Logout</button>
<h1>
    MyFancyRetailer Shop
</h1>
<hr>
<?php
    $customerID = $_GET["customerID"];
    
    echo "<button name=\"shoppingcart\" onclick=\"window.location.href='checkout.php?customerID=$customerID';\" style=\"background-color: transparent; border-style: none\">";
    echo "<img src=\"assets/shoppingcart.png\" alt=\"shoppingcart\" class=\"shoppingcart\">";
    echo "</button>";
    echo "<button name=\"wishlist\" onclick=\"window.location.href='wishlist.php?customerID=$customerID';\" style=\"float:right; background:cyan; margin-top:2%; margin-right:1%; color:black; height:10%;\">View WishList</button>";

?>
<div class="rt-container">
    <div class="col-rt-12">
        <ul class="image-list-small">
            <?php
                require_once('connect.php');
                require_once('DB_Functions.php');

                $customerID = $_GET["customerID"];
            
                $dbh = ConnectDB();
                $return = ListAllProducts($dbh);
                
                $counter = 0;
                foreach ( $return as $number ) {
                    $name = str_replace(' ', '', $number->Pname);
                    $name = str_replace(':', '', $name);
                    $UPC = $number->UPC;
                    $Pname = $number->Pname;
                    $Price = $number->price;
                    $Count = $number->amount;
                    $counter++;

                    echo "<li>";
                    echo "<a href=\"productInformation.php?customerID=$customerID&UPC=$UPC\" class=\"image\" style=\"background-image: url(assets/products_img/$name.jpg);\"></a>";
                    echo "<div class=\"pname\">";
                    echo "<a href=\"productInformation.php?customerID=$customerID&UPC=$UPC\" style=\"color:black\">$Pname</a>";
                    echo "</div>";

                    echo "<div class=\"price\">";
                    echo "<a href=\"productInformation.php?customerID=$customerID&UPC=$UPC\" style=\"color:black\">$$Price</a>";
                    echo "</div>";

                    $return2 = avgProdRating($dbh, $UPC);
                    $avgRating = '';

                    foreach ( $return2 as $number ) {
                        $avgRating = $number->avgRating;
                    }
                    
                    $avgRating = number_format($avgRating, 2);
                    $avgRating = ($avgRating / 5) * 100;
                    
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
                    
                    echo "<div class=\"count\">";
                    echo "<a href=\"productInformation.php?customerID=$customerID&UPC=$UPC\" style=\"color:black\">Quantity: $Count</a>";
                    echo "</div>";
                    echo "</li>";
                }
            ?>
        </ul>
    </div>
</div>
</body>

<script>
    $(document).ready(function(){
    $("#apply").on("click", function(e){
        e.preventDefault();
        $(".rating-upper").css({
            width: $("#p").val() + "%"
        });
    });
});
</script>

</html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="allProductPages.css">
    <link rel="stylesheet" type="text/css" href="checkouts.css">
</head> 
<br>
<div class="buttGroup">
    <button class="logout2" name="logout2" onclick="window.location.href='index.html';">Logout</button>
    <?php
        $customerID = $_GET["customerID"];
        echo "<button class=\"back\" name=\"back\" onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Back to Shopping</button>";
    ?>
</div>
<h1>
    MyFancyRetailer Shop
</h1>
<hr>

<?php
    echo "<br><h3>Here is your order summary: </h3>";
    echo "<table>";
    echo "<tr><th>Item Name</th><th>Price</th><th>Quantity</th>";

    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    
    //$UPC = $_GET['UPC'];
    $customerID = $_GET["customerID"];
    $returnOrderID = getCurrentOrderNumber($dbh, $customerID);
    $orderID = '';

    foreach ( $returnOrderID as $number ) {
        $orderID = $number->orderID;
    }
    $return = orderInfo($dbh, $customerID, $orderID);

    $totalPrice = '';
    $totalQuantity = '';

    foreach ( $return as $number ) {
        $OG_Pname = $number->Pname;
        $Price = $number->price;    
        $Quantity = $number->quantity;
        $UPC = $number->UPC;
        

        echo "<tr>";
        //echo "<td>$OG_Pname</td>";
        echo "<td><a href=\"productInformation.php?customerID=$customerID&UPC=$UPC\">$OG_Pname</a></td>";
        echo "<td>$$Price</td>";
        echo "<td>$Quantity</td>";
        echo "<td><button style=\"background-color:black;\" onclick=\"window.location.href='orderCartRemove.php?customerID=$customerID&UPC=$UPC';\">Remove from Cart</button></td>";
        echo "</tr>";
    }

    $return2 = summaryOrderInfo($dbh, $customerID, $orderID);
    foreach ( $return2 as $number ) {
        $totalPrice = $number->sumPrice;
        $totalQuantity = $number->sumQuantity;
    }
    echo "<tr><th></th><th>Total Amount</th><th>Total Quantity</th></tr>";
    echo "<tr><td></td>";
    echo "<td>$$totalPrice</td>";
    echo "<td>$totalQuantity</td></tr>";
    echo "</table>";
    
    $check = countNumProdInOrder($dbh, $orderID);
    $return3 = '';
    foreach ( $check as $number ) {
        $return3 = $number->count;
    }
    // prevents checking out if there are no products in the cart
    if ($return3 == 0)
    {

    }
    else
    {
        echo "<button class=\"order\" name=\"order\" onclick=\"window.location.href='completeOrder.php?customerID=$customerID&orderID=$orderID';\">Place Order</button>";
    }
?>

</html>
<script>

</script>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="allProductPages.css">
    <link rel="stylesheet" type="text/css" href="checkout.css">
    <style>
        .logout1 {
            margin-left: 45%;
        }
        .reorder {
            margin-left: 42.3%;
            margin-top: 1%;
            background-color: green;
            height: 10%;
            width: 15%;
        }
    </style>
</head> 
<br>
<h1>
    MyFancyRetailer Shop
</h1>
<hr>

<?php
    require_once('connect.php');
    require_once('DB_Functions.php');

    $dbh = ConnectDB();
    
    $customerID = $_GET["customerID"];
    $orderID = $_GET["orderID"];
    $orderDate = date("Y-m-d");
    $paymentType = $_GET["paymentType"];
    $CCN = $_GET["CCN"];

    finalizeOrder($dbh, $orderID, $orderDate, $paymentType, $CCN);
    createOrder($dbh, $customerID);

    echo "<br><h3>Your order is completed!</h3>";

echo "<button class=\"logout1\" name=\"logout1\" onclick=\"window.location.href='index.html';\">Logout</button>";
echo "<button class=\"reorder\" name=\"reorder\" onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Place another Order</button>";

?>

</html>
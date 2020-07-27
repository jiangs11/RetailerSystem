<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="allProductPages.css">
    <link rel="stylesheet" type="text/css" href="completeOrder.css">
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

<br>
<h3>Check Out Order</h3>

<div>
<form action="finalizeOrder.php" method="get"> 
    <h4>Fill out the payment information below:</h4>
    <div class="select" name="select">
        <select id="paymentType" name="paymentType" style="margin-left:40%;font-size:16px;height:5%;width:15%;">
            <option value="" disable selected hidden> Payment Option </option>
            <option value=VISA> VISA </option>
            <option value=MC> MC </option>
            <option value=DISCOVER> DISCOVER </option>
        </select>
    </div>
    <br><br>
    <label for="ccn" style="margin-left:40%;font-size:20px;">Credit Card Number: </label>
    <input type="text" id="CCN" name="CCN" style="margin-left:40%;height:4%;width:20%;"><br><br>

    <?php
        $customerID = $_GET["customerID"];
        $orderID = $_GET["orderID"];

        echo "<input type=hidden name=customerID value=$customerID>";
        echo "<input type=hidden name=orderID value=$orderID>";
    ?>
    <br>
    <input type="submit" value="Submit" style="margin-left:40%;font-size:20px;font-weight:bolder;background-color:lime;color:white;width:8%;height:5%;">
</form>
</div>
<!-- <button class="order" name="order" onclick="window.location.href='completeOrder.php?customerID=$customerID';">Complete</button> -->

</html>
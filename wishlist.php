<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="wishlist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<br>

<body>
<?php
    require_once('connect.php');
    require_once('DB_Functions.php');
    $dbh = ConnectDB();
    $customerID = $_GET['customerID'];

    echo "<div class=\"buttGroup\">";
    echo "<button class=\"logout2\" name=\"logout2\" onclick=\"window.location.href='index.html';\">Logout</button>";
    echo "<button class=\"back\" name=\"back\" onclick=\"window.location.href='productsList.php?customerID=$customerID';\">Back to Shopping</button>";
    echo "</div>";

    $name = customerName($dbh, $customerID);
    foreach ( $name as $number) {
        $fname = $number->Fname;
        $lname = $number->Lname;
        echo "<h1>WishList for Customer: $fname $lname</h1>";
    }

    echo "<table>";
    echo "<tr><th>Item Name</th><th></th>";

    $return = viewWishList($dbh, $customerID);

    foreach ( $return as $number ) {
        $OG_Pname = $number->Pname;
        $UPC = $number->UPC;

        echo "<tr>";
        echo "<td><a href=\"productInformation.php?customerID=$customerID&UPC=$UPC\">$OG_Pname</a></td>";
        echo "<td><button onclick=\"window.location.href='wishListRemove.php?customerID=$customerID&UPC=$UPC';\">Remove from List</button></td>";
        echo "</tr>";
    }

?>

</body>
</html>
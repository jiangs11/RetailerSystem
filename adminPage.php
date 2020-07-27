<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="loginPage.css">
</head>
<body>
<br>
<h2>MyFancyRetailer System</h2>
<br>
<h3 style="font-size: 36px;">Admin Page</h3>
<h3>Here are your options:</h3>
<br>
<button class="initButton" name="customer" onclick="window.location.href = 'adminModify/customerInfo/modifyCustomer.php';">Customer Information</button>
<button class="initButton" name="register" onclick="window.location.href = 'adminModify/supplierInfo/modifySupplier.php';">Supplier Information</button>
<button class="initButton" name="admin" onclick="window.location.href = 'adminModify/productInfo/modifyProduct.php';">Product Information</button>

<img src="assets/excel.png" alt="retailer" class="retailer" style="margin-top: 3%;">
<br>
<button class="logout" name="logout" style="font-size:25px;font-weight:bolder;width: 10%; margin-left: 45%;" onclick="window.location.href='index.html';">Logout</button>
</body>
</html>

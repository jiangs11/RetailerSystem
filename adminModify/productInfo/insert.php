<?php
$connect = mysqli_connect();
if(isset($_POST["UPC"], $_POST["Pname"]))
{
    $UPC = mysqli_real_escape_string($connect, $_POST["UPC"]);
    $Pname = mysqli_real_escape_string($connect, $_POST["Pname"]);
    $Sname = mysqli_real_escape_string($connect, $_POST["Sname"]);
    $price = mysqli_real_escape_string($connect, $_POST["price"]);
    $amount = mysqli_real_escape_string($connect, $_POST["amount"]);
    $reorderlevel = mysqli_real_escape_string($connect, $_POST["reorderlevel"]);
    $query = "INSERT INTO product(UPC, Pname, Sname, price, amount, reorderlevel) VALUES('$UPC', '$Pname', '$Sname', '$price', '$amount', '$reorderlevel')";
    if(mysqli_query($connect, $query))
    {
        echo "Added new product!";
    }
}
?>
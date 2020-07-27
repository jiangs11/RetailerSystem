<?php
$connect = mysqli_connect();
if(isset($_POST["id"]))
{
    $query = "DELETE FROM product WHERE UPC = '".$_POST["id"]."'";
    if(mysqli_query($connect, $query))
    {
        echo "Product was deleted!";
    }
}
?>
<?php
$connect = mysqli_connect();
if(isset($_POST["id"]))
{
    $query = "DELETE FROM supplier WHERE Sname = '".$_POST["id"]."'";
    if(mysqli_query($connect, $query))
    {
        echo "Supplier was deleted!";
    }
    else
    {
        echo "A product is associated with that supplier!";
        echo " Must first delete the product first!";
    }
}
?>
<?php
$connect = mysqli_connect( );
if(isset($_POST["id"]))
{
    $query = "DELETE FROM customer WHERE customerID = '".$_POST["id"]."'";
    if(mysqli_query($connect, $query))
    {
        echo "Customer was deleted!";
    }
}
?>
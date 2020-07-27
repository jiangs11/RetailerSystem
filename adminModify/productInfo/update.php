<?php
$connect = mysqli_connect();
if(isset($_POST["id"]))
{
    $value = mysqli_real_escape_string($connect, $_POST["value"]);
    $query = "UPDATE product SET ".$_POST["column_name"]."='".$value."' WHERE UPC = '".$_POST["id"]."'";

    if(mysqli_query($connect, $query))
    {
        $column = $_POST["column_name"];
        echo "Product $column info updated!";
    }
    else
    {
        echo "That column can't be updated!";
    }
}
?>

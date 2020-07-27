<?php
$connect = mysqli_connect();
if(isset($_POST["Sname"]))
{
    $Sname = mysqli_real_escape_string($connect, $_POST["Sname"]);
    $city = mysqli_real_escape_string($connect, $_POST["city"]);
    $zip = mysqli_real_escape_string($connect, $_POST["zip"]);
    $query = "INSERT INTO supplier(Sname,city, zip) VALUES('$Sname', '$city', '$zip')";
    if(mysqli_query($connect, $query))
    {
        echo "Added new supplier!";
    }
}
?>
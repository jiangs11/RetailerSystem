<?php
$connect = mysqli_connect( );
if(isset($_POST["Fname"], $_POST["Lname"]))
{
    $Fname = mysqli_real_escape_string($connect, $_POST["Fname"]);
    $Lname = mysqli_real_escape_string($connect, $_POST["Lname"]);
    $address = mysqli_real_escape_string($connect, $_POST["address"]);
    $city = mysqli_real_escape_string($connect, $_POST["city"]);
    $state = mysqli_real_escape_string($connect, $_POST["state"]);
    $zip = mysqli_real_escape_string($connect, $_POST["zip"]);
    $query = "INSERT INTO customer(Fname, Lname, address, city, state, zip) VALUES('$Fname', '$Lname', '$address', '$city', '$state', '$zip')";
    if(mysqli_query($connect, $query))
    {
        echo "Added new customer!";
    }
}
?>
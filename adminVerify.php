<?php
    $username = $_GET["username"];
    $password = $_GET["password"];

    if ($username == "root" and $password == "root")
    {
        echo "<script type=\"text/javascript\">location.href = 'adminPage.php';</script>";
    }
    else
    {
        echo "<script type=\"text/javascript\">location.href = 'adminLoginForm.html';</script>";
    }
?>
<?php
session_start();
if (isset($_POST["submit"])) {
    if ($_POST['otp'] == "") {
        header("location:otp.php?error=emptyfield");
        exit();
    } 
    else {
        if ($_SESSION['otp'] == $_POST['otp']) {
            header("location:resetpwd.php");
        } else {
            header("location:otp.php?error=wrongotp");
        }
    } 
}

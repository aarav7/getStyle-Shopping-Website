<?php
session_start();
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="getstyle";
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("connection failed");
}
if (isset($_POST["submit"])) {
    if (($_POST['pwd'] == "") || ($_POST['pwdrepeat'] == "")) {
        header("location:resetpwd.php?error=emptyfields");
        exit();
    } else {
        $pwd = $_POST['pwd'];
        $pwdrepeat = $_POST['pwdrepeat'];
        if($pwd!==$pwdrepeat){
            header("location:resetpwd.php?error=passwordsdontmatch");
            exit();
        }
        else{
            $pwd = mysqli_real_escape_string($conn, $pwd);
            $passhashed = sha1($pwd);

            $stmt = mysqli_prepare($conn, "UPDATE users SET Password = ? WHERE UserId = '".$_SESSION['customerId']."'");
            if (!$stmt) {
                header("location:resetpwd.php?error=stmterror1");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $passhashed);
            
            if (mysqli_stmt_execute($stmt)) {
                session_unset();
                session_destroy();
                header("location:login.php?status=2");
            } else {
                header("location:resetpwd.php?error=stmterror2");
                exit();
            }
        }
    } 
} 
<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "getStyle";
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("connection failed");
}
if (isset($_POST["submit"])) {
    if ($_POST['name'] == "") {
        header("location:verification.php?error=emptyfield");
        exit();
    } else {
        $name = $_POST['name'];

        $name = mysqli_real_escape_string($conn, $name);

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE Username = ? OR Email = ?");
        if (!$stmt) {
            header("location:verification.php?error=stmterror1");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $name, $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION["customerId"] = $row["UserId"];
            $otp=rand(10000,99999);
            $_SESSION["otp"] = $otp;
		    $to=$row["Email"];
		    $subject='Reset Password';
		    $message="Your One Time Password is:".$otp;
		    $header = "From: getStyle";
		    $result= mail($to,$subject,$message,$header);
		    if($result){
		        header('location:otp.php');
		    }
		    else{
		    	header("location:verification.php?error=internalerror");
		    }
        } else {
            header("location:verification.php?error=wronglogin");
        }
    } //first else block closes
}//main or first if block closes

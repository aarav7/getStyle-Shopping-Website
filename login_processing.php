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
    if (($_POST['name'] == "") || ($_POST['pwd'] == "")) {
        header("location:login.php?error=emptyfields");
        exit();
    } else {
        $name = $_POST['name'];
        $pass = $_POST['pwd'];

        $name = mysqli_real_escape_string($conn, $name);
        $pass = mysqli_real_escape_string($conn, $pass);

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE Username = ? OR Email = ?");
        if (!$stmt) {
            header("location:login.php?error=stmterror1");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $name, $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $passhashed = $row["Password"];
            if ($passhashed === sha1($pass)) {
                session_start();
                $_SESSION["customerId"] = $row["UserId"];
                mysqli_stmt_close($stmt);
                header("location:index.php");
            } else {
                header("location:login.php?error=wrongpassword");
            }
        } else {
            header("location:login.php?error=wronglogin");
            exit();
        }
    } //first else block closes
}//main or first if block closes

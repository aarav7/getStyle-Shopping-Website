<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="getStyle";
	$conn= mysqli_connect($db_host, $db_user, $db_password, $db_name);
	if(!$conn)
	{
		die("connection failed");
	}
	if(isset($_POST["submit"])){
    
		if(($_POST['name'] == "") || ($_POST['email'] == "") || ($_POST['uname'] == "")||($_POST['pwd'] == "")||($_POST['pwdrepeat'] == "")){
		    echo "Fill all fields";
		}
	    else{
	        $name = $_POST['name'];
		    $email = $_POST['email'];
		    $uname = $_POST['uname'];
		    $pass = $_POST['pwd'];
		    $passrepeat = $_POST['pwdrepeat'];

		    $name= mysqli_real_escape_string($conn, $name);
		    $email=mysqli_real_escape_string($conn, $email);
		    $uname=mysqli_real_escape_string($conn, $uname);
            $pass=mysqli_real_escape_string($conn, $pass);
            $passrepeat=mysqli_real_escape_string($conn, $passrepeat);
		    $uid=rand(100000,999999);
            $result=mysqli_query($conn, "SELECT * FROM users");
		    $entries = mysqli_fetch_all($result, MYSQLI_ASSOC);
            while(in_array($uid, array_column($entries, 'Username'))){
                $uid=rand(100000,999999);
            }

            if($pass!==$passrepeat){
                header("location:signup.php?error=passwordsdontmatch");
                exit();
            }

            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE Username = ? OR Email = ?");
            if(!$stmt){
                header("location:signup.php?error=stmterror1");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "ss", $uname, $email);
            mysqli_stmt_execute($stmt);
            if(mysqli_num_rows(mysqli_stmt_get_result($stmt))>0){
                header("location:login.php?status=0");
                exit();
            }
            mysqli_stmt_close($stmt);

            //User details are ready to be entered into the database

            $pass= sha1($pass);
            $stmt = mysqli_prepare($conn, "INSERT INTO users(UserId, Name, Email, Username, Password) VALUES(?, ?, ?, ?, ?)");
            if(!$stmt){
                header("location:signup.php?error=stmterror2");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "issss", $uid, $name, $email, $uname, $pass);
            mysqli_stmt_execute($stmt);
            header("location:login.php?status=1");
	   }//first else block closes
	}//main or first if block closes

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
		    header("location:signup.php?error=emptyfields");
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
            while(in_array($uid, array_column($entries, 'UserId'))){
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
            $resultObj = mysqli_stmt_get_result($stmt);
            $result = mysqli_fetch_all($resultObj, MYSQLI_ASSOC);
            $uname_column = array_column($result, 'Username');
            $email_column = array_column($result, 'Email');
            
            if(in_array($uname, $uname_column) && in_array($email, $email_column)){
                header("location:signup.php?error=userexists");
                exit();
            }
            if(in_array($uname, $uname_column)){
                header("location:signup.php?error=unameexists");
                exit();
            }
            if(in_array($email, $email_column)){
                header("location:signup.php?error=emailexists");
                exit();
            }

            mysqli_stmt_close($stmt);
            // if(mysqli_num_rows(mysqli_stmt_get_result($stmt))>0){
            //     header("location:signup.php?error=userexists");
            //     mysqli_stmt_close($stmt);
            //     exit();
            // }

            //User details are ready to be entered into the database

            $pass= sha1($pass);
            $stmt = mysqli_prepare($conn, "INSERT INTO users(UserId, Name, Email, Username, Password) VALUES(?, ?, ?, ?, ?)");
            if(!$stmt){
                header("location:signup.php?error=stmterror2");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "issss", $uid, $name, $email, $uname, $pass);
            if(mysqli_stmt_execute($stmt)){
                header("location:login.php?status=1");
            }
            else{
                header("location:signup.php?error=stmterror3");
            }
            
	   }//first else block closes
	}//main or first if block closes

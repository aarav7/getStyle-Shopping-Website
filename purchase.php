<!-- <?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="getStyle";

	$conn= mysqli_connect($db_host, $db_user, $db_password, $db_name);
	if(!$conn)
	{
		die("connection failed");
	}
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(($_REQUEST['First_name'] == "") || ($_REQUEST['Last_name'] == "") || ($_REQUEST['email'] == "")){
		    echo "Fill all fields";
		}
	    else{
	        $fn = isset($_REQUEST['First_name'])? $_REQUEST['First_name']:'';
		    $ln = isset($_REQUEST['Last_name'])? $_REQUEST['Last_name']:'';
		    $em = isset($_REQUEST['email'])? $_REQUEST['email']:'';
		    $gender = isset($_REQUEST['Gender'])? $_REQUEST['Gender']:'';
		    $Membership = isset($_REQUEST['Membership'])? $_REQUEST['Membership']:'';
		    $fn=mysqli_real_escape_string($conn, $fn);
		    $ln=mysqli_real_escape_string($conn, $ln);
		    $em=mysqli_real_escape_string($conn, $em);
		    $_SESSION["fn"]=$fn;
		    $_SESSION["ln"]=$ln;
		    $_SESSION["em"]=$em;
		    $_SESSION["gender"]=$gender;
		    $_SESSION["Membership"]=$Membership;
		    $vkey=rand(10000,99999);
		    $to=$em;
		    $subject='Registration OTP';
		    $message="Please put the given OTP in veification box: ".$vkey;
		    $header="From: localhost/gymandfit/form.php";
		    $result= mail($to,$subject,$message,$header);
		    if($result){
		    	mysqli_query($conn, "INSERT INTO otp(vkey,is_expired,created_at) VALUES('".$vkey."',0,'".date("Y-m-d H:i:s")."')");
		         header('location:otp.php');
		        }
		    else{
		    	echo "unable to proceed";
		    }
	   }//first else block closes
	}//main or first if block closes
?> -->
<!DOCTYPE html>
<html>

<head>
	<title>Information</title>
	<link rel="stylesheet" type="text/css" href="style/nav.css">
    <link rel="stylesheet" type="text/css" href="style/info.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
		integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
</head>

<body style="background-color:antiquewhite;">
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn text-danger">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo display-4 text-danger"> <i class="fas fa-shopping-bag"></i>&nbsp;getStyle</label>
       <ul>
                    <li>
                        <a class="text-dark btn btn-danger" href="index.php">Home</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#products">Products</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#">About</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#footer">Contact</a>
                    </li>
                    <li>
                        <?php
                            $count=0;
                            if(isset($_SESSION["cart"])){
                                $count=count($_SESSION["cart"]);
                            } 
                        ?>
                        <a class="text-dark btn btn-danger" type="submit" <?php if($count){echo'href="cart.php"';}?>><i
                                class="fas fa-shopping-cart"></i><?php if($count){echo"$count";} ?>&nbsp; Cart</a>
                    </li>
                </ul>
                        </nav>
		<div class="container">
					<div class="card">
						<div class="card-body">
							<div class="text-center">
								<h2 class="card-title text-danger">Fill Information</h2>
								<hr>
							</div>
							<form action="form.php" class="border border-light" method="POST">
								<div class="form-group text-danger">
									<i class="fas fa-user"></i>
									<label for="name" class="display-1 white-text">
										<h4>Full Name:</h4>
									</label>
									<input type="text" name="First_name" class="white-text form-control"
										placeholder="Full Name" required>
								</div>
								<hr>
								<div class="form-group text-danger">
									<i class="fas fa-envelope"></i>
									<label for="email" class="display-4 white-text">
										<h4>Email:</h4>
									</label>
									<input type="email" name="email" class="white-text form-control" placeholder="Email"
										required>
								</div>
								<hr>
                                <div class="form-group text-danger">
									<i class="fas fa-phone"></i>
									<label for="phone" class="display-4 white-text">
										<h4>Phone No:</h4>
									</label>
									<input type="number" name="phone" class="white-text form-control" placeholder="Phone Number"
										required>
								</div>
								<hr>
                                <div class="form-group text-danger">
									<i class="fas fa-map-marker-alt"></i>
									<label for="name" class="display-1 white-text">
										<h4>Address:</h4>
									</label>
									<input type="text" name="address" class="white-text form-control"
										placeholder="Address" required>
								</div>
								<hr>
								<div class="text-center">
									<button class="btn btn-outline-danger" type="Submit" id="btn"
										name="submit">Order</button>
								</div>
							</form>
						</div>
					</div>
				</div>
	<script src="https://kit.fontawesome.com/d5f8b6c1a9.js" crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$conn = mysqli_connect("localhost", "root", "", "getStyle");
if (!$conn) {
	die("Connection Failed");
}

if (isset($_POST["add-cart"])) {
	if (isset($_SESSION["customerId"])) {
		if (isset($_SESSION["cart"])) {
			$arr = array_column($_SESSION["cart"], 'id');
			if (in_array($_POST["id"], $arr)) {
				$k = array_search($_POST["id"], $arr);
				if ($_SESSION["cart"][$k]["Quantity"] != $_POST["quantity"]) {
					$_SESSION["cart"][$k] = array('id' => $_POST["id"], 'product_name' => $_POST["prod_name"], 'Price' => $_POST["price"], 'Quantity' => $_POST["quantity"]);
					echo "
					<script>
					window.location.href='index.php';
					</script>";
				} else {
					echo "
					<script>
					alert('Product Already Added in Cart');
					window.location.href='index.php';
					</script>";
				}
			} else {
				$count = count($_SESSION['cart']);
				$_SESSION["cart"][$count] = array('id' => $_POST["id"], 'product_name' => $_POST["prod_name"], 'Price' => $_POST["price"], 'Quantity' => $_POST["quantity"]);
				echo "<script>
				window.location.href='index.php';
				</script>";
			}
		} else {
			$_SESSION["cart"][0] = array('id' => $_POST["id"], 'product_name' => $_POST["prod_name"], 'Price' => $_POST["price"], 'Quantity' => $_POST["quantity"]);
			echo "<script>
				window.location.href='index.php';
				</script>";
		}
	} else {
		echo "<script>
			alert('Please Login or Signup first to shop.');
			window.location.href='index.php';
			</script>";
	}
}
if (isset($_POST["remove_cart"])) {
	if (isset($_SESSION["cart"])) {
		foreach ($_SESSION["cart"] as $key => $value) {
			if ($value["id"] == $_POST["id"]) {
				unset($_SESSION["cart"][$key]);
				if ($_SESSION["cart"] != NULL) {
					$_SESSION["cart"] = array_values($_SESSION["cart"]);
					echo "<script>
					window.location.href='cart.php';
					</script>";
				} else {
					echo "<script>
					window.location.href='index.php';
					</script>";
				}
			}
		}
	}
}
if (isset($_POST["new_quantity"])) {
	foreach ($_SESSION['cart'] as $key => $value) {
		if ($value['id'] == $_POST["id"]) {
			$_SESSION["cart"][$key]["Quantity"] = $_POST["new_quantity"];
		}
	}
	echo "
		<script>
			window.location.href='cart.php';
		</script>";
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if (isset($_POST["sendMessage"])) {
	// if(($_POST['name'] == "") || ($_POST['message'] == "") || ($_POST['email'] == "")){
	//     echo "
	// 	<script>
	// 	alert('Fill all fields');
	// 	window.location.href='index.php';
	// 	</script>";
	// }
	// else{
	// 	$name = test_input($_POST['name']);
	// 	$email = test_input($_POST['email']);
	// 	$message =  test_input($_POST['message']);
	// }
	if (($_POST['message'] == "")) {
		echo "
			<script>
			alert('Fill the message field');
			window.location.href='index.php';
			</script>";
	} else {
		$message =  test_input($_POST['message']);
		$message = mysqli_real_escape_string($conn, $message);
		$stmt = mysqli_prepare($conn, "INSERT INTO queries(UserId, Message) VALUES(?, ?)");
		if (!$stmt) {
			header("location:index.php?error=stmterror");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "is", $_SESSION["customerId"], $message);
		mysqli_stmt_execute($stmt);
		echo "
			<script>
			alert('Your message has reached us. We will look into the matter as soon as possible.');
			window.location.href='index.php';
			</script>";
	}
}

if (isset($_POST["make_pay"]) && $_POST["radio"] == "2") {
	// echo "
	// 	<script>
	// 	window.location.href='purchase.php';
	// 	</script>";
	$orderId = "ORDS" . rand(10000, 99999999);
	$customerAdd = mysqli_real_escape_string($conn, $_POST["address"]);
	$phone = mysqli_real_escape_string($conn, $_POST["phone"]);
	$date = date("Y-m-d H:i:s");
	$total = 0;
	foreach ($_SESSION["cart"] as $key => $value) {
		$total = $total + $value['Quantity'] * $value['Price'];
	}
	$payMode = "COD";
	$txnId = rand(1000000000000, 9999999999999);
	$result = mysqli_query($conn, "SELECT * FROM transactions");
	$entries = mysqli_fetch_all($result, MYSQLI_ASSOC);
	while (in_array($txnId, array_column($entries, 'TxnId'))) {
		$txnId = rand(1000000000000, 9999999999999);
	}

	$stmt = mysqli_prepare($conn, "INSERT INTO transactions(TxnId, UserId, OrderId, PayMode, TxnAmount, TxnDate) VALUES(?, ?, ?, ?, ?, ?)");
	if (!$stmt) {
		header("location:cart.php?error=stmterror");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "sissds", $txnId, $_SESSION["customerId"], $orderId, $payMode, $total, $date);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	$stmt = mysqli_prepare($conn, "INSERT INTO orders(OrderId, ProdId, Quantity, Amount, ShipAddress, ContactNo) VALUES(?, ?, ?, ?, ?, ?)");
	if(!$stmt){
		header("location:cart.php?error=stmterror");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "siidss", $orderId, $id, $Quantity, $prod_total, $customerAdd, $phone);
	foreach ($_SESSION["cart"] as $key => $value) {
		$prod_total = $value["Quantity"] * $value["Price"];
		$id = $value["id"];
		$Quantity = $value["Quantity"];
		mysqli_stmt_execute($stmt);
	}
	mysqli_stmt_close($stmt);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE UserId='" . $_SESSION["customerId"] . "'");
	$row1 = mysqli_fetch_assoc($result);
	$result = mysqli_query($conn, "SELECT * FROM orders WHERE OrderId='" . $orderId . "'");
	$message = "Order Id: " . $orderId . "\nTransaction Id: " . $txnId . "\nYour order which was\n";
	while ($row2 = mysqli_fetch_assoc($result)) {
		$prod_info = mysqli_query($conn, "SELECT * FROM products WHERE prod_id='" . $row2["ProdId"] . "'");
		$row3 = mysqli_fetch_assoc($prod_info);
		$message .= $row2["Quantity"] . " " . $row3["prod_name"] . "\n";
	}
	$message .= "will be delivered to your given address within 3 days.";
	$to = $row1["Email"];
	$subject = "Order Successful";
	$header = "From: getStyle";
	$result = mail($to, $subject, $message, $header);
	echo "<script>
            setTimeout(function(){window.location.href='thankyou.php';}, 4000);
        </script>";
}
if (isset($_POST["make_pay"]) && $_POST["radio"] == "1") {
?>
	<html>

	<head>
		<title></title>
	</head>

	<body>
		<form method="post" action="PaytmKit/pgRedirect.php" name="f1">
			<?php
			echo '<input type="hidden" name="ORDER_ID" value="' . $_POST["ORDER_ID"] . '">';
			echo '<input type="hidden" name="CUST_ID" value="' . $_POST["CUST_ID"] . '">';
			echo '<input type="hidden" name="INDUSTRY_TYPE_ID" value="' . $_POST["INDUSTRY_TYPE_ID"] . '">';
			echo '<input type="hidden" name="CHANNEL_ID" value="' . $_POST["CHANNEL_ID"] . '">';
			echo '<input type="hidden" name="TXN_AMOUNT" value="' . $_POST["TXN_AMOUNT"] . '">';
			$_SESSION["customerAdd"] = mysqli_real_escape_string($conn, $_POST["address"]);
			$_SESSION["phone"] = mysqli_real_escape_string($conn, $_POST["phone"]);
			?>
			<script type="text/javascript">
				document.f1.submit();
			</script>

		</form>
	</body>

	</html>
<?php

}
?>
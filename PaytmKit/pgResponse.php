<?php
session_start();
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="getStyle";

$conn= mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(!$conn)
{
	die("connection failed");
}
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		$stmt = mysqli_prepare($conn, "INSERT INTO transactions(TxnId, UserId, OrderId, PayMode, TxnAmount, TxnDate) VALUES(?, ?, ?, ?, ?, ?)");
        if(!$stmt){
            header("location:../cart.php?error=stmterror");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sissds", $_POST["TXNID"], $_SESSION["customerId"], $_POST["ORDERID"], $_POST["PAYMENTMODE"], $_POST["TXNAMOUNT"], $_POST["TXNDATE"]);
        mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		$stmt= mysqli_prepare($conn, "INSERT INTO orders(OrderId, ProdId, Quantity, Amount, ShipAddress, ContactNo) VALUES(?, ?, ?, ?, ?, ?)");
		
		mysqli_stmt_bind_param($stmt, "siidss", $_POST["ORDERID"], $id, $Quantity, $prod_total, $_SESSION["customerAdd"], $_SESSION["phone"]);
        foreach($_SESSION["cart"] as $key=>$value){
          $prod_total= $value["Quantity"]*$value["Price"];
		  $id= $value["id"];
		  $Quantity= $value["Quantity"];
		  mysqli_stmt_execute($stmt);
		}

		mysqli_stmt_close($stmt);
		// header("location:../thankyou.php");
		$result=mysqli_query($conn, "SELECT * FROM users WHERE UserId='".$_SESSION["customerId"]."'");
		$row1=mysqli_fetch_assoc($result);
		$result= mysqli_query($conn, "SELECT * FROM orders WHERE OrderId='".$_POST["ORDERID"]."'");
		$message="Order Id: ".$_POST["ORDERID"]."\nTransaction Id: ".$_POST["TXNID"]."\nYour order which was\n";
		while($row2=mysqli_fetch_assoc($result)){
			$prod_info= mysqli_query($conn, "SELECT * FROM products WHERE prod_id='".$row2["ProdId"]."'");
			$row3=mysqli_fetch_assoc($prod_info);
			$message.=$row2["Quantity"]." ".$row3["prod_name"]."\n";
		}
		$message.="will be delivered to your given address within 3 days.";
		$to=$row1["Email"];
		$subject="Order Successful";
		$header="From: getStyle";
		$result= mail($to,$subject,$message,$header);
		echo"
        <script>
            setTimeout(function(){window.location.href='../thankyou.php';}, 4000);
        </script>
        ";
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}
 
	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>
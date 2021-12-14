<?php 
session_start();
if (isset($_POST["add-cart"])){
	if(isset($_SESSION["customerId"])){
		if(isset($_SESSION["cart"])){
			$arr= array_column($_SESSION["cart"], 'id' );
			if(in_array($_POST["id"], $arr )){
				$k=array_search($_POST["id"], $arr);
				if($_SESSION["cart"][$k]["Quantity"]!=$_POST["quantity"]){
					$_SESSION["cart"][$k]=array('id' =>$_POST["id"] , 'product_name' =>$_POST["prod_name"], 'Price' => $_POST["price"], 'Quantity' => $_POST["quantity"] );
					echo"
					<script>
					window.location.href='index.php';
					</script>";

				}
				else{
					echo"
					<script>
					alert('Product Already Added in Cart');
					window.location.href='index.php';
					</script>";
				}
			}
			else{
				$count=count($_SESSION['cart']);
				$_SESSION["cart"][$count]=array('id' =>$_POST["id"] , 'product_name' =>$_POST["prod_name"], 'Price' => $_POST["price"], 'Quantity' => $_POST["quantity"] );
				echo"<script>
				window.location.href='index.php';
				</script>";
			}

		}
		else{
			$_SESSION["cart"][0]=array('id' =>$_POST["id"] , 'product_name' =>$_POST["prod_name"], 'Price' => $_POST["price"], 'Quantity' => $_POST["quantity"] );
			echo"<script>
				window.location.href='index.php';
				</script>";
		}
	}
	else{
		echo"<script>
			alert('Please Login or Signup first to shop.');
			window.location.href='index.php';
			</script>";
	}
}
if(isset($_POST["remove_cart"])){
	if(isset($_SESSION["cart"])){
		foreach ($_SESSION["cart"] as $key => $value) {
			if($value["id"]==$_POST["id"]){
				unset($_SESSION["cart"][$key]);
				if($_SESSION["cart"]!=NULL){
					$_SESSION["cart"]=array_values($_SESSION["cart"]);
					echo"<script>
					window.location.href='cart.php';
					</script>";
				}
				else{
					echo"<script>
					window.location.href='index.php';
					</script>";
				}
			}
		}
	}
}
	if(isset($_POST["new_quantity"])){
		foreach($_SESSION['cart'] as $key=>$value){
			if($value['id']==$_POST["id"]){
				$_SESSION["cart"][$key]["Quantity"]=$_POST["new_quantity"];
			}
		}
		echo"
		<script>
			window.location.href='cart.php';
		</script>"; }

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}
	if(isset($_POST["sendMessage"])){
		if(($_POST['name'] == "") || ($_POST['message'] == "") || ($_POST['email'] == "")){
		    echo "
			<script>
			alert('Fill all fields');
			window.location.href='index.php';
			</script>";
		}
		else{
			$name = test_input($_POST['name']);
			$email = test_input($_POST['email']);
			$message =  test_input($_POST['message']);
		}
		
	}

	if(isset($_POST["make_pay"]) && $_POST["radio"]=="2"){
		// echo "
		// 	<script>
		// 	window.location.href='purchase.php';
		// 	</script>";
		header('location:purchase.php');
	}
?>



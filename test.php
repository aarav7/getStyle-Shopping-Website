<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"]=="POST"){
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
<?php
 session_start();
?>
<!doctype html>
<html lang="en">
  <head> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link href="style/nav.css" type="text/css" rel="stylesheet">
    <link href="style/cart.css" type="text/css" rel="stylesheet">

    <title>cart</title>
  </head>
  <body>
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
                        <a class="text-dark btn btn-danger" href="#">Products</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#">About</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#">Contact</a>
                    </li>
                     <li>
                        <?php
                            $count=0;
                            if(isset($_SESSION["cart"])){
                                $count=count($_SESSION["cart"]);
                            } 
                        ?>
                        <a class="text-dark btn btn-danger" type="submit" <?php if($count){echo'href="cart.php"';}?> target="#"><i
                                class="fas fa-shopping-cart"></i><?php if($count){echo"$count";} ?>&nbsp; Cart</a>
                    </li>
                </ul>
    </nav>
    <div class="container">
        <h1 id="cart-body-head" class="text-danger mt-2">YOUR CART</h1>
      <div class="row">
      <div class="cart-body-main col-lg-9 col-12">
        <table class="table">
  <thead class="text-center">
    <tr>
      <th scope="col" class='text-danger'>id</th>
      <th scope="col" class='text-danger'>Product Name</th>
      <th scope="col" class='text-danger'>Price</th>
      <th scope="col" class='text-danger'>Quantity</th>
      <th scope="col" class='text-danger'>Total Price</th>
      <th scope="col" class='text-danger'></th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php
      if(isset($_SESSION["cart"])){
        $total=0;
        foreach($_SESSION['cart'] as $key=>$value){
          $total= $total + $value['Quantity']*$value['Price'];
          $prod_total= $value['Quantity']*$value['Price'];
          echo"
          <tr class='text-danger' style='border-bottom: 1px solid ;'>
            <th>$value[id]</th>
            <td>$value[product_name]</td>
            <td>₹$value[Price]</td>
            <td>
            <form method='POST' action='manage_cart.php'>
            <input type='number' name='new_quantity' class='text-center form-control bg-dark text-danger' onchange='this.form.submit()' style='width:80px; margin-left:auto; margin-right:auto;' min=1 value='$value[Quantity]'>
            <input type='hidden' name='id' value='$value[id]'>
            </form>
            </td>
            <td>₹$prod_total</td>
            <td><form method='POST' action='manage_cart.php'><button type='submit' class='btn btn-danger btn-sm' name='remove_cart'>Remove</button>
            <input type='hidden' name='id' value='$value[id]'>
            </form></td>
          </tr>
          ";
        }
      }
    ?>
  </tbody>
</table>
      </div>
      <div class="total-price col-lg-3 col-12">
        <div class="total-price-box p-4 m-0">
          <h4 class="text-danger">Total:</h4>
          <span class="text-white">₹<?php echo $total; ?></span>
          <div class="payment">
            <form method="POST" action="manage_cart.php">
            <div class="form-check">
              <input type="radio" class="form-check-input" id="radio1" name="radio" value="1">
              <label for="radio1" class="form-check-label">UPI PAYMENT</label>
            </div>
            <div class="form-check">
              <input type="radio" class="form-check-input" id="radio2" name="radio" value="2">
              <label for="radio2">CASH ON DELIVERY</label>
            </div>
            <div class="button-container">
              <button type="submit" name="make_pay" class="btn btn-danger">Make Payment</button> 
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

     <script src="https://kit.fontawesome.com/d5f8b6c1a9.js" crossorigin="anonymous"></script>

     <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
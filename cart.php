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
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <div class="logo d-flex align-items-center">
      <img src="images/logo.svg" alt="logo" class="logo-img d-block mr-2">
      &nbsp;
      &nbsp;
      &nbsp;
      <span class="">getStyle</span>
    </div>
    <ul>
      <li>
        <a class="text-dark" href="index.php">Home</a>
      </li>
      <li>
        <a class="text-dark" href="index.php#products">Products</a>
      </li>
      <li>
        <a class="text-dark" href="index.php#footer">Contact</a>
      </li>
      <?php
      if (isset($_SESSION["customerId"])) {
        echo "
                        <li>
                            <a class='text-dark' href='logout.php'>Logout</a>
                        </li>";
      } else {
        echo "
                        <li>
                            <a class='text-dark' href='login.php'>Login</a>
                        </li>
                        <li>
                            <a class='text-dark' href='signup.php'>Signup</a>
                        </li>";
      }
      ?>
      <li>
        <?php
        $count = 0;
        if (isset($_SESSION["cart"])) {
          $count = count($_SESSION["cart"]);
        }
        ?>
        <a class="text-dark" type="submit" <?php if ($count) {
                                              echo 'href="cart.php"';
                                            } ?>><i class="fas fa-shopping-cart"></i><?php if ($count) {
                                                                                        echo "($count)";
                                                                                      } ?>&nbsp; Cart</a>
      </li>
    </ul>
  </nav>

  <div class="container mt-4 pt-4">
    <h1 id="cart-body-head" class="text-dark text-left mb-2" style="text-align:left">Your Cart</h1>
    <div class="row">
      <div class="cart-body-main col-lg-8 col-12">
        <table class="table">
          <thead class="text-center">
            <tr>
              <th scope="col" class='text-dark'>id</th>
              <th scope="col" class='text-dark'>Product Name</th>
              <th scope="col" class='text-dark'>Price</th>
              <th scope="col" class='text-dark'>Quantity</th>
              <th scope="col" class='text-dark'>Total Price</th>
              <th scope="col" class='text-dark'></th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php
            if (isset($_SESSION["cart"])) {
              $total = 0;
              foreach ($_SESSION['cart'] as $key => $value) {
                $total = $total + $value['Quantity'] * $value['Price'];
                $prod_total = $value['Quantity'] * $value['Price'];
                echo "
          <tr class='text-dark' style='border-bottom: 1px solid #d2d2d2;'>
            <th>$value[id]</th>
            <td>$value[product_name]</td>
            <td>₹$value[Price]</td>
            <td>
            <form method='POST' action='manage_cart.php'>
            <input type='number' name='new_quantity' class='text-center form-control text-dark bg-white' onchange='this.form.submit()' style='width:80px; margin-left:auto; margin-right:auto;' min=1 value='$value[Quantity]'>
            <input type='hidden' name='id' value='$value[id]'>
            </form>
            </td>
            <td>₹$prod_total</td>
            <td><form method='POST' action='manage_cart.php'><button type='submit' class='btn btn-dark btn-sm' name='remove_cart'>Remove</button>
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
      <div class="total-price col-lg-4 col-12">
        <div class="total-price-box p-4 pt-0 m-0">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <span class="total-title text-black mb-0 mt-auto">Total:</span>
            <span class="total text-black">₹<?php echo $total; ?></span>
          </div>
          <div class="payment">
            <form method="POST" action="manage_cart.php">
              <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000, 99999999) ?>">
              <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $_SESSION["customerId"]; ?>">
              <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
              <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
              <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $total; ?>">


              <div class="form-check mb-2">
                <input type="radio" class="form-check-input" id="radio1" name="radio" value="1" required>
                <label for="radio1" class="form-check-label text-dark">PAYTM PAYMENT</label>
              </div>
              <div class="form-check mb-2">
                <input type="radio" class="form-check-input" id="radio2" name="radio" value="2" required>
                <label for="radio2" class="form-check-label text-dark">CASH ON DELIVERY</label>
              </div>
              <div class="form-group mb-2">
                <input type="tel" class="form-control contact" id="phone" name="phone" placeholder="Enter your contact no." required pattern="[0-9]{10}" maxlength="10">
              </div>
              <div class="form-group mb-4">
                <textarea id="address" class="form-control" name="address" rows="3" placeholder="Enter your address..." required></textarea>
              </div>
              <div class="button-container">
                <button type="submit" name="make_pay" class="w-100 btn btn-dark">Make Payment</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script>
  </script>
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
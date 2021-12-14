<?php
    session_start();
    $con= mysqli_connect("localhost", "root", "", "getStyle");
    if(!$con){
        echo "Connection Failed";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head> 

    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>getStyle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link href="style/index.css" rel="stylesheet" type="text/css">
    <link href="style/nav.css" rel="stylesheet">

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
                        <a class="text-dark btn btn-danger" href="#">Home</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#products">Products</a>
                    </li>
                    <li>
                        <a class="text-dark btn btn-danger" href="#footer">Contact</a>
                    </li>
                    <?php
                    if(isset($_SESSION["customerId"])){
                         echo"
                        <li>
                            <a class='text-dark btn btn-danger' href='logout.php'>Logout</a>
                        </li>";
                    }
                    else{
                        echo"
                        <li>
                            <a class='text-dark btn btn-danger' href='login.php'>Login</a>
                        </li>
                        <li>
                            <a class='text-dark btn btn-danger' href='signup.php'>Signup</a>
                        </li>";
                    }
                    ?>
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

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid" src="a.jpg">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="b.jpg">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="c.jpg">
            </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <section id="products">
        <div class="head-container m-0">
            <h1  class="text-danger text-center m-0">Products</h1>
        </div>
        <div class="body-container">
            <div class="row m-2">
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>                            
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='1'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id">
                                <input type="hidden" name="prod_name">
                                <input type="hidden" name="price">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='2'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="2">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>   
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"><h3>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='3'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="3">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                           <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='4'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="4">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            <!-- </div> -->
           <!--  <div class="row m-2"> -->
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                           <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='5'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="5">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='6'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="6">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='7'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="7">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='8'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="8">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
<!--             </div> -->
            <!-- <div class="row m-2"> -->
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='9'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="9">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='10'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="10">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title text-danger"></h4>                            
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='11'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="11">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-3 col-md-4 my-2">
                <form method="POST" action="manage_cart.php">
                    <div class="card">
                        <div class="inner">
                            <img class="card-img-top">
                        </div>
                        <div class=" card-body">
                            <h4 class="card-title text-danger"></h4>
                            <h5 class="card-title text-danger"></h5>
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach($_SESSION['cart'] as $key=>$value){if($value['id']=='12'){echo $value['Quantity'];}} ?>" required min="1">
                                <input type="hidden" name="id" value="12">
                                <input type="hidden" name="prod_name" value="Product">
                                <input type="hidden" name="price" value="500">
                                <button class="btn btn-danger add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to 
                                    cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
    <section id="footer">
        <!-- <footer class="page-footer p-4">
            <div class="container">
                <ul class="list-unstyled list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#" id="fb">
                            <i class="fab fa-facebook fa-2x text-danger"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="twitter">
                            <i class="fab fa-twitter fa-2x text-danger"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="google">
                            <i class="fab fa-google-plus-g fa-2x text-danger"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="linkedin">
                            <i class="fab fa-linkedin-in fa-2x text-danger"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" id="instagram">
                            <i class="fab fa-instagram fa-2x text-danger"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="text-center">
                <h4 class="text-white">(c) 2021 COPYRIGHT: getStyle</h4>
            </div>
        </footer> -->
    <div style="width: 100%;" class="container">
      <h2 id="contactHeading" class="text-danger">Contact</h2>
      <div id="contact" class="row mb-2">
        <div class="col-md-6 mt-2">
          <form action="manage_cart.php" method="POST" id="my-form">
            <div class="input-container">
              <!-- <label class="contact-inputs" for="validationCustom01"></label> -->
              <input type="text" class="form-control form-control-lg contact-input-tags" id="validationCustom01"
                placeholder="Enter your name" name="name">
            </div>
            <div class="input-container mt-2">
              <!-- <label class="contact-inputs" for="validationCustom02"></label> -->
              <input type="email" class="form-control form-control-lg contact-input-tags" id="validationCustom02"
                placeholder="Enter your email address" name="email">
            </div>
            <div class="input-container mt-2">
              <!-- <label class="contact-inputs" for="validationCustom03"></label> -->
              <textarea type="text" class="form-control form-control-lg contact-input-tags" id="validationCustom03"
                placeholder="Enter your message here . . ." rows="4" name="message"></textarea>
            </div>
            <div class="mt-2">
              <button id="contactBtn" class="btn bg-danger btn-md" type="submit" name="sendMessage">Submit</button>
            </div>
          </form>
          <div id="status"></div>
        </div>


        <div id="social-section" class="col-md-6 mt-2">
          <p style="color:white;font-size:large; font-weight: 400;">In case a query pops up in your head or you are
            looking for a
            collaboration, feel
            free to reach out to us. Just drop in a mail, call us up or join us at our office for a nice coffee.<br>
            P.S.-We really make some delicious ones!</p>
          <ul id="contactList" class="list-unstyled fa-ul">
            <li class="list-group-item bg-black"><a href="#" class="text-danger" 
                style="text-decoration: none;"><span class="fa-li"><i
                    class="fa fa-2x fa-map-marker mr-5 social-icon" aria-hidden="true"></i></span>Our Office</a>
            </li>
            <li class="list-group-item bg-black">
              <a href="#" class="text-danger"  style="text-decoration: none;"><span
                  class="fa-li"><i class="fa fa-2x fa-envelope mr-5 social-icon"
                    aria-hidden="true"></i></span>aaravpant07@gmail.com</a>
            </li>
            <li class="list-group-item bg-black">
              <a href="#" class="text-danger" style="text-decoration: none;"><span class="fa-li"><i
                    class="fa fa-2x fa-phone mr-5 social-icon" aria-hidden="true"></i></span>+91 7055145182</a>
            </li>
            <li class="list-group-item" style="display: none;"></li>
          </ul>
        </div>
        <div id="social-media-icons" class="d-flex justify-content-center">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a href="#" title="Facebook"><i
                  class="fa fa-2x fa-facebook-square social-media text-danger" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" title="Linkedin"><i
                  class="fa fa-2x fa-linkedin-square social-media text-danger" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" title="Twitter"><i
                  class="fa fa-2x fa-twitter social-media text-danger" aria-hidden="true"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" title="Instagram"><i
                  class="fa fa-2x fa-instagram social-media text-danger" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </section>

        <?php
    
    $query= mysqli_query($con, "SELECT * FROM products");
        if(mysqli_num_rows($query) > 0){
            echo "<script>
            let card;
            card = document.getElementsByClassName('card');";
            while($row=mysqli_fetch_array($query)){
                echo "card[".--$row['prod_id']."].getElementsByClassName('card-img-top')[0].setAttribute('src', 'images/".++$row['prod_id'].".jpg');
                card[".--$row['prod_id']."].getElementsByClassName('card-title')[0].innerHTML='".$row['prod_name']."';
                card[".$row['prod_id']."].getElementsByClassName('card-title')[1].innerHTML='₹".$row['prod_price']."';
                card[".$row['prod_id']."].querySelector('input[name=\"id\"]').value='".++$row['prod_id']."';
                card[".--$row['prod_id']."].querySelector('input[name=\"prod_name\"]').value='".$row['prod_name']."';
                card[".$row['prod_id']."].querySelector('input[name=\"price\"]').value='".$row['prod_price']."';
                 ";
            }
            echo"</script>";
        }
        ?>
          <script src="https://kit.fontawesome.com/d5f8b6c1a9.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">

    

</body>

</html>
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "getStyle");
if (!$conn) {
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
    <link href="style/preset.css" rel="stylesheet">
    <link href="style/footer.css" rel="stylesheet">

</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <div class="logo d-flex align-items-center m-1">
            <img src="images/logo.svg" alt="logo" class="logo-img d-block mr-2">
            &nbsp;
            &nbsp;
            &nbsp;
            <span class="">getStyle</span>
        </div>
        <ul>
            <li>
                <a class="text-dark" href="#">Home</a>
            </li>
            <li>
                <a class="text-dark" href="#products">Products</a>
            </li>
            <li>
                <a class="text-dark" href="#footer">Contact</a>
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

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid" src="images/a.jpg">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/b.jpg">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/c.jpg">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/d.jpg">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/e.jpg">
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <section id="products">
        <div class="head-container m-0">
            <div class="product-title text-center m-4">Our Products</div>
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '1') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="prod_name">
                                    <input type="hidden" name="price">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '2') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="2">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title">
                                    <h3>
                                        <h5 class="card-title"></h5>
                                        <div class="form-group">
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                        if ($value['id'] == '3') {
                                                                                                                                            echo $value['Quantity'];
                                                                                                                                        }
                                                                                                                                    } ?>" required min="1">
                                            <input type="hidden" name="id" value="3">
                                            <input type="hidden" name="prod_name" value="Product">
                                            <input type="hidden" name="price" value="500">
                                            <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '4') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="4">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '5') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="5">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '6') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="6">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '7') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="7">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '8') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="8">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '9') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="9">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '10') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="10">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '11') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="11">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
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
                                <h4 class="card-title"></h4>
                                <h5 class="card-title"></h5>
                                <div class="form-group">
                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="<?php foreach ($_SESSION['cart'] as $key => $value) {
                                                                                                                                if ($value['id'] == '12') {
                                                                                                                                    echo $value['Quantity'];
                                                                                                                                }
                                                                                                                            } ?>" required min="1">
                                    <input type="hidden" name="id" value="12">
                                    <input type="hidden" name="prod_name" value="Product">
                                    <input type="hidden" name="price" value="500">
                                    <button class="add-to-cart btn add-cart mt-1" name="add-cart" type="submit"><i class="fas fa-shopping-cart"></i>Add to
                                        cart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer" id="footer">
        <div class="footer_top d-md-flex flex-wrap justify-content-between align-items-start">
            <img src="images/footerLogo.svg" alt="footerLogo" class="footerLogo m-4" />
            <form action="manage_cart.php" method="POST" id="my-form" class="m-2">
                <div class="footer-form-title text-white">Need Help?</div>
                <div class="input-container mt-2">
                    <textarea type="text" class="form-control form-control-lg contact-input-tags" id="validationCustom03" placeholder="Enter your message here . . ." rows="4" name="message"></textarea>
                </div>
                <div class="mt-2">
                    <button id="contactBtn" class="btn btn-md" type="submit" name="sendMessage">Submit</button>
                </div>
                <div id="status"></div>
            </form>
            <ul class="footer_socials">
                <li class="footer_link_title">FOLLOW US ON</li>
                <div class="footer_social_icons d-flex align-items-center">
                    <li>
                        <a href="/" alt="facebook">
                            <img src="images/fb.svg" alt="facebook" />
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="insta">
                            <img src="images/insta.svg" ]} alt="insta" />
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="snap">
                            <!-- <img src="images/snap.svg"]} alt="snap" /> -->
                            <i class="fa fa-2x fa-twitter social-media" style="color: white" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="lin">
                            <img src="images/lin.svg" ]} alt="lin" />
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="yt">
                            <img src="images/yt.svg" ]} alt="yt" />
                        </a>
                    </li>
                </div>
            </ul>
        </div>
        <div class="footer_bottom d-flex flex-wrap">
            <ul class="footer_bottom_links d-flex justify-content-center align-items-center">
                <div class="footer_bottom_left d-flex justify-content-center align-items-center">
                    <li>
                        <a href="/" alt="footer-bottom-link">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="footer-bottom-link">
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="footer-bottom-link">
                            Return Policy
                        </a>
                    </li>
                    <li>
                        <a href="/" alt="footer-bottom-link">
                            Disclaimer
                        </a>
                    </li>
                </div>
                <li class="footer_bottom_right">© 2021 GETSTYLE.
            </ul>
        </div>
        </div>
    </footer>

    <?php

    $query = mysqli_query($conn, "SELECT * FROM products");
    if (mysqli_num_rows($query) > 0) {
        echo "<script>
            let card;
            card = document.getElementsByClassName('card');";
        while ($row = mysqli_fetch_array($query)) {
            echo "card[" . --$row['prod_id'] . "].getElementsByClassName('card-img-top')[0].setAttribute('src', 'images/" . ++$row['prod_id'] . ".jpg');
                card[" . --$row['prod_id'] . "].getElementsByClassName('card-title')[0].innerHTML='" . $row['prod_name'] . "';
                card[" . $row['prod_id'] . "].getElementsByClassName('card-title')[1].innerHTML='₹" . $row['prod_price'] . "';
                card[" . $row['prod_id'] . "].querySelector('input[name=\"id\"]').value='" . ++$row['prod_id'] . "';
                card[" . --$row['prod_id'] . "].querySelector('input[name=\"prod_name\"]').value='" . $row['prod_name'] . "';
                card[" . $row['prod_id'] . "].querySelector('input[name=\"price\"]').value='" . $row['prod_price'] . "';
                 ";
        }
        echo "</script>";
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
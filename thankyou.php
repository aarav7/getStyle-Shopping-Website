<html>
<head>
<title>Checkout</title>
</head>
<body>
	<center><h1>Thank you for shopping. You will be redirected to the main page...</h1></center>
    <?php
        session_start();
        unset($_SESSION["cart"]);
        echo"
        <script>
            setTimeout(function(){window.location.href='index.php';}, 4000);
        </script>
        ";
    ?>
</body>
</html>
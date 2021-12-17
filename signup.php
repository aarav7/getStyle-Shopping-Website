<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="style/login.css" type="text/css" rel="stylesheet">
  <title>Signup</title>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="row d-flex justify-content-center align-items-center w-100">
        <div class="col-xl-10 m-5 p-5">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <h4 class="login-form-title text-left mb-4">Sign Up</h4>

                  <form action="signup_processing.php" method="POST">

                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example11">Full Name</label>
                      <input type="text" id="form2Example11" class="form-control" name="name" required autofocus>
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example22">Email</label>
                      <input type="email" id="form2Example22" class="form-control" name="email" required>
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example33">Username</label>
                      <input type="text" id="form2Example33" class="form-control" name="uname" required>
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example44">Password</label>
                      <input type="password" id="form2Example44" class="form-control" name="pwd" required>
                    </div>

                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example55">Repeat Password</label>
                      <input type="password" id="form2Example55" class="form-control" name="pwdrepeat" required>
                    </div>
                    <button class="btn btn-dark btn-block mb-4 d-block ml-auto" style="margin-left:auto" name="submit" type="submit">Sign Up</button>
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Already have an account?</p>
                      <a href="login.php" class="text-primary">Login here</a>
                    </div>
                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="px-3 py-4 p-md-5 mx-md-4 d-flex">
                  <a href="index.php"><img src="images/logo-large.svg" alt="logo"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  if (isset($_GET['error'])) {
    if ($_GET["error"] == "passwordsdontmatch") {
      echo "<script>
        alert('Please make sure both the passwords entered match each other.');
        </script>";
    } else {
      echo "<script>
        alert('This is an error from our side and we are really sorry for it. We are fixing it, try again after sometime.');
        </script>";
    }
  }
  ?>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
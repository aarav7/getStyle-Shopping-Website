<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="style/log-sign.css" type="text/css" rel="stylesheet">
  <title>Reset Password</title>

</head>

<body>
  <section class="h-100 gradient-login-form" style="background-color: #eee;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="row d-flex justify-content-center align-items-center w-100 resetpwd">
        <!-- <div class="col-xl-10 mt-2"> -->
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="px-3 py-4 p-md-5 mx-md-4 d-flex">
                  <a href="index.php"><img src="images/logo-large.svg" alt="logo"></a>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <h4 class="login-form-title text-left mb-4">Reset Password</h4>

                  <form action="resetpwd_processing.php" method="POST" onsubmit="return validate();">

                    <div class="form-outline mb-4">
                      <label class="form-label" for="pwd">Set New Password</label>
                      <input type="password" id="pwd" class="form-control" placeholder="New Password" name="pwd" required autofocus />
                      <span class="invalid" style="color:red; font-size:small; display:none">Password must be atleast 8 characters long and must contain atleast one uppercase character, one lowercase character, one numeric value and one special symbol.</span>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="pwdrepeat">Repeat New Password</label>
                      <input type="password" id="pwdrepeat" class="form-control" name="pwdrepeat" placeholder="Repeat New Password" required />
                      <span class="invalid" style="color:red; font-size:small; display:none">Please enter the same password as entered above.</span>
                    </div>
                    <div class="text-right">
                      <button class="btn btn-dark btn-block mb-4 d-block ml-auto" style="margin-left:auto" name="submit" type="submit">Done</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </section>
  <?php
  if (isset($_GET['error'])) {
    if($_GET["error"] == "emptyfields"){
      echo "<script>
        alert('Please fill all fields.');
        </script>";
        exit();
    }
    if ($_GET["error"] == "passwordsdontmatch") {
      echo "<script>
        alert('Please make sure both the passwords entered match each other.');
        </script>";
    }
    else{
      echo "<script>
        alert('This is an error from our side and we are really sorry for it. We are fixing it, try again after sometime.');
        </script>";
    }
    }
  ?>

    <script>
    function validate(){

      let pwd=document.getElementById("pwd").value;
      let pwdrepeat=document.getElementById("pwdrepeat").value;

      let invalid=document.getElementsByClassName("invalid");
      for(i=0;i<2;i++){
        invalid[i].style.display = 'none';
      }

      let pwdCheck=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])[A-Za-z0-9!@#\$%\^&\*]{8,}$/;

      if(!pwdCheck.test(pwd)){
        invalid[0].style.display = 'inline';
        return false;
      }
      else{
        invalid[0].style.display = 'none';
      }

      if(pwd!=pwdrepeat){
        invalid[1].style.display = 'inline';
        return false;
      }
      else{
        invalid[1].style.display = 'none';
      }
      return true;
    }
  </script>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
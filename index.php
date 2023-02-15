<?php
 include ('./controllers/loginAuth.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    name="viewport">
  <link rel="shortcut icon" href="./dist/img/favicon.fw.png">
  <title>I-World Networks Web App</title>

  <link rel="stylesheet" href="./dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="./dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="./dist/css/demo.css">
  <link rel="stylesheet" href="./dist/css/style.css">

  <link rel="stylesheet" href="./assets/sweetalert/css/sweetalert2.min.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="./dist/img/iworld-logo.fw.png">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login Here</h4>
              </div>

              <div class="card-body">
                <form method="POST" id="loginForm" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="d-block">Password
                      <div class="float-right">
                        <a href="#">
                          Forgot Password?
                        </a>
                      </div>
                    </label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" id="login" name="login" class="btn btn-primary btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="register.html">Create One</a>
            </div> -->
            <div class="simple-footer">
              Copyright &copy; I-World Networks <?php echo date("Y"); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Sweet Alert -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="./assets/sweetalert/js/sweetalert2.min.js"></script>

  <script src="./dist/modules/jquery.min.js"></script>
  <script src="./dist/modules/popper.js"></script>
  <script src="./dist/modules/tooltip.js"></script>
  <script src="./dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="./dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="./dist/modules/moment.min.js"></script>
  <script src="./dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="./dist/js/sa-functions.js"></script>

  <script src="./dist/js/scripts.js"></script>
  <script src="./dist/js/custom.js"></script>
  <!-- <script src="./dist/js/demo.js"></script> -->



</body>

</html>
<?php
 include ('./controllers/loginAuth.php');


//  Get all payment details from URL here
$accountName = $_GET['accountName'];
$invoiceNumber = $_GET['invoiceNumber'];
$email = $_GET['email'];
$amount = $_GET['amount'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
        name="viewport">
    <link rel="shortcut icon" href="./dist/img/favicon.fw.png">
    <title>I-World Networks Online Payment</title>

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
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="./dist/img/I-World Networks Logo.fw.png">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Payment Details</h3>
                            </div>

                            <div class="card-body">
                                <form method="POST" id="loginForm" action="" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email"> Customer Account Name</label>
                                        <input id="customerAccountName" type="text" class="form-control"
                                            name="customer_account_name" tabindex="1"
                                            value="<?php echo $accountName; ?>" readonly="readonly" required autofocus>
                                    </div>

                                    <div class=" form-group">
                                        <label for="email"> Invoice Number</label>
                                        <input id="invoiceNumber" type="text" class="form-control" name="invoice_number"
                                            tabindex="1" value="<?php echo $invoiceNumber; ?>" readonly="readonly"
                                            required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="email"> Email</label>
                                        <input id="email" type="text" class="form-control" name="email" tabindex="1"
                                            value="<?php echo $email; ?>" readonly="readonly" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="email"> Amount </label>
                                        <input id="amount" type="text" class="form-control" name="amount" tabindex="1"
                                            value="<?php echo $amount; ?>" readonly="readonly" required autofocus>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" id="login" name="login" class="btn btn-primary btn-block"
                                            tabindex="4" style="background-color: #729635 !important;">
                                            Pay Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="register.html">Create One</a>
            </div> -->
                        <!-- <div class="simple-footer">
                            Copyright &copy; I-World Networks 2021
                        </div> -->
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
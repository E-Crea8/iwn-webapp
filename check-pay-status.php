<?php
include('inc/dbcon.php');

//  Get all payment details from URL here
$customerAccountName = $_GET['accountName'];
$invoiceNumber = $_GET['invoiceNumber'];
$email = $_GET['email'];
$amount = $_GET['amount'];

// Check if Customer's already made payment
if (isset($_POST['checkPay'])) {
  $customer_account_name = $_POST['customer_account_name'];
  $invoice_number = $_POST['invoice_number'];
  $newEmail = $_POST['email'];
  $newAmount = $_POST['amount'];

  $checkPaymentExist = "SELECT * FROM subscription WHERE invoice_number = '$invoice_number'";
  $docheckPaymentExist = mysqli_query($dbc, $checkPaymentExist);
  $checkIfNotEmpty = mysqli_num_rows($docheckPaymentExist);

  if($checkIfNotEmpty > 0){
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal.fire("Oops!"," You have already paid for this invoice and your subscription has been activated.<br> Still having issues with your subscription? Please reach out to us <a href=mailto:account@iworldnetworks.net?subject=InternetSubscriptionIssues>here</a> ","warning");';
    echo '}, 1000);</script>';

  }
  else{
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal.fire("Check Payment!"," Please, kindly click OK to check your payment information","info").then( () => {
location.href = "pay?accountName='.$customer_account_name.'&invoiceNumber='.$invoice_number.'&email='.$newEmail.'&amount='.$newAmount.'"
});';
    echo '}, 1000);
    </script>';


  }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
        name="viewport">
    <link rel="shortcut icon" href="./dist/img/favicon.fw.png">
    <title>I-World Networks - Online Payment</title>

    <link rel="stylesheet" href="./dist/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dist/modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="./dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="./dist/css/demo.css">
    <link rel="stylesheet" href="./dist/css/style.css">

    <link rel="stylesheet" href="./assets/sweetalert/css/sweetalert2.min.css">
    <script src="https://js.paystack.co/v1/inline.js"></script>

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="./dist/img/iworld-logo.fw.png" alt="I-World Networks Logo">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 style="text-align: center; font-size: 20px;">Internet Subscription Payment</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <!-- <label for="email"> Customer Account Name</label> -->
                                        <input id="customerAccountName" type="hidden" class="form-control"
                                            name="customer_account_name" tabindex="1"
                                            value="<?php echo $customerAccountName; ?>" readonly="readonly" required
                                            autofocus>
                                    </div>

                                    <div class=" form-group">
                                        <!-- <label for="email"> Invoice Number</label> -->
                                        <input id="invoiceNumber" type="hidden" class="form-control" name="invoice_number"
                                            tabindex="1" value="<?php echo $invoiceNumber; ?>" readonly="readonly"
                                            required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="email"> Email</label> -->
                                        <input id="email" type="hidden" class="form-control" name="email" tabindex="1"
                                            value="<?php echo $email; ?>" readonly="readonly" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="email"> Amount </label> -->
                                        <input id="amount" type="hidden" class="form-control" name="amount" tabindex="1"
                                            value="<?php echo $amount; ?>" readonly="readonly" required autofocus>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" name="checkPay" class="btn btn-primary btn-block"
                                            tabindex="4" style="background-color: #729635 !important;"
                                            >
                                            Proceed
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
    <!-- <script src="./dist/modules/moment.min.js"></script> -->
    <script src="./dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
    <script src="./dist/js/sa-functions.js"></script>

    <script src="./dist/js/scripts.js"></script>
    <script src="./dist/js/custom.js"></script>
    <!-- <script src="./dist/js/demo.js"></script> -->



</body>

</html>
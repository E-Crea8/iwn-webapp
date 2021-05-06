<?php
//  include ('./controllers/loginAuth.php');


//  Get all payment details from URL here
$customerAccountName = $_GET['accountName'];
$invoiceNumber = $_GET['invoiceNumber'];
$email = $_GET['email'];
$amount = $_GET['amount'];

// Add form values into Sessions
// if(empty($accountName) || empty($invoiceNumber) || empty($email) || empty($amount)){
//     header("Location: pay");
//     }else{
     session_start();
    $_SESSION['customer_account_name'] =  $customerAccountName;
    $_SESSION['invoice_number'] =  $invoiceNumber;
    $_SESSION['email']  = $email;
    $_SESSION['amount']  = $amount;
    
    //echo $first_name;
    //echo $email;
    
    // }

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
                            <img src="./dist/img/I-World Networks Logo.fw.png">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Payment Details</h3>
                            </div>

                            <div class="card-body">
                                <form method="POST" id="paymentForm" action="" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email"> Customer Account Name</label>
                                        <input id="customerAccountName" type="text" class="form-control"
                                            name="customer_account_name" tabindex="1"
                                            value="<?php echo $customerAccountName; ?>" readonly="readonly" required
                                            autofocus>
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
                                        <button type="button" id="login" name="pay" class="btn btn-primary btn-block"
                                            tabindex="4" style="background-color: #729635 !important;"
                                            onclick="payWithPaystack()">
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

    <!-- Paystack Payments Script -->
    <script>
    function payWithPaystack() {
        const api = "pk_test_fa2df4ca7fea60ef6a625543478dbfabf3c5b508";
        var handler = PaystackPop.setup({
            key: api,
            email: "<?php echo $email; ?>",
            amount: <?php echo $amount*100; ?>,
            currency: "NGN",
            // ref: '' + Math.floor((Math.random() * 1000000000) +
            //     1
            // ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            customerAccountName: "<?php echo". $customerAccountName."; ?>",
            invoiceNumber: "<?php echo $invoiceNumber; ?>",
            email: "<?php echo $email; ?>",
            // label: "Optional string that replaces customer email"
            metadata: {
                custom_fields: [{
                        display_name: "Customer Account Name:",
                        variable_name: "customer_account_name",
                        value: "<?php echo $customerAccountName; ?>"
                    },
                    {
                        display_name: "Invoice Number:",
                        variable_name: "invoice_number",
                        value: "<?php echo $invoiceNumber; ?>"
                    },
                    {
                        display_name: "Email:",
                        variable_name: "email",
                        value: "<?php echo $email; ?>"
                    },
                    {
                        display_name: "Amount",
                        variable_name: "amount",
                        value: "<?php echo $amount; ?>"
                    }
                ]
            },
            callback: function(response) {
                const referenced = response.reference;
                window.location.href = 'payment-success.php?successfullyPaid=' + referenced;
            },
            onClose: function() {
                alert('window closed');
            }
        });
        handler.openIframe();
    }
    </script>
    </script>

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
<?php
// Connect Payment DB
include_once("./inc/paymentDB.php");


session_start();
if(!$_GET["successfullyPaid"]){
  header("Location: pay");
  exit;
}else{
  $reference  =  $_GET["successfullyPaid"];
}
$customerAccountName = $_SESSION["customer_account_name"];
$invoiceNumber = $_SESSION["invoice_number"];
$email = $_SESSION["email"];
$amount = $_SESSION["amount"];


// Submit Payment Data to the Database
//Insert into database
$sql ="INSERT INTO subscription(customer_account_name, invoice_number, email, amount, reference)
   VALUES(:customer_account_name, :invoice_number,  :email, :amount, :reference)";
   if($stmt = $pdo->prepare($sql)){
  //Bind parameters
  $stmt->bindParam(':customer_account_name', $customerAccountName, PDO::PARAM_STR);
  $stmt->bindParam(':invoice_number', $invoiceNumber, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
    $stmt->bindParam(':reference', $reference, PDO::PARAM_STR);
    //Attempt to execute
    if($stmt->execute()){
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Success!","Your payment with the invoice number '.$invoiceNumber.'  was processed successfully. Click OK to go to client zone","success").then( () => {
location.href = "https://iworldnetworks.unmsapp.com/crm/client-zone"});';
        echo '}, 1000);
        </script>';        
$last_id = $pdo->lastInsertId();
    //  echo $last_id;
     //Prevent resubmission
     session_unset();
     session_destroy(); 
    }else{
        die("Sorry, something went wrong with your payment!");
    }
    unset($stmt);
    //close connection
    unset($pdo);
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
        name="viewport">
    <link rel="shortcut icon" href="./dist/img/favicon.fw.png">
    <title>I-World Networks - Payment Success</title>

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
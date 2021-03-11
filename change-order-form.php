<?php
 include ('./controllers/functions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="./dist/img/favicon.fw.png">
  <title>I-World Networks Web App</title>

  <link rel="stylesheet" href="./dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="./dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="./dist/css/demo.css">
  <link rel="stylesheet" href="./dist/css/style.css">
  
  <link rel="stylesheet" href="./assets/sweetalert/css/sweetalert2.min.css">
  <style>
      .formField{
        width: 25%; 
        padding-left: 10px; 
        text-align: left; 
        font-family: Georgia, 'Times New Roman', Times, serif; 
        font-size: 16px; 
        font-weight: 600;
      }

    .main-content-2 {
    padding-left: 250px;
    padding-right: 250px;
    padding-top: 80px;
    width: 100%;
    position: relative;
}  
</style>
</head>

<body style="background-color: #FFFFFF !important;">
<div class="main-content-2">
        <section class="section">
          <h1 class="section-header">
            <div>Change Order Form For Internet Service<br>
        <span style="font-size:12px; font-weight:normal; color:#FF0000;">Kindly fill all the fields</span></div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <!-- <div class="alert alert-info mb-0">
                  We use 'Toastr' made by @CodeSeven. You can check the full documentation <a href="http://www.toastrjs.com/">here</a>.
                </div> -->
                <?php
                if(isset($_POST['create-change-order-form'])){
                    InternetChangeOrderForm(); //here goes the function call
               }
               ?>


                <form name="create-ip-order-form" method="POST">

                <div class="form-header-label">Section A: Equipment Replacement</div>
                <!-- Row 1 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="customer_name">Customer Name</label>
                      <input id="customerName" type="text" class="form-control" name="customer_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="customer_address">Customer Address</label>
                    <textarea class="form-control" id="customerAddress" name="customer_address" row="3" col="3" autofocus required></textarea>
                    </div>
                  </div>

                <!-- Row 2 -->
                <div class="row">
                    <div class="form-group col-6">
                    <label for="customer_email">Customer Email(s)</label>
                      <input id="customerEmail" type="email" class="form-control" name="customer_email" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="customer_phone">Customer Phone(s)</label>
                      <input id="customerPhone" type="text" class="form-control" name="customer_phone" autofocus required>
                    </div>
                  </div>

                  <div class="form-header-label">Section B: Account Manager's Details </div>
                <!-- Row 3 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="acct_mgr_name">Account Manager's Name</label>
                      <input id="acctMgrName" type="text" class="form-control" name="acct_mgr_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                        <label for="acct_mgr_email">Account Manager's Email</label>
                        <input id="acctMgrEmail" type="email" class="form-control" name="acct_mgr_email" autofocus required>
                    </div>
                  </div>

                  <div class="form-header-label">Service change details</div>
                <!-- Row 4 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="current_plan">Current Plan</label>
                      <select class="form-control" id="currentPlan" name="current_plan" required>
                        <option disabled="disabled" selected="selected">Select Plan</option>
                        <option disabled="disabled">Home/Residential Unlimited Plan</option>

                        <option value="H-LITE Unlimited">H-LITE Unlimited</option>
                        <option value="H-MAX Unlimited">H-MAX Unlimited</option>
                        <option value="H-PRO Unlimited">H-PRO Unlimited</option>
                        
                        <option disabled="disabled">SME's Unlimited Plan</option>
                        <option value="U-LITE">U-LITE</option>
                        <option value="U-MAX">U-MAX</option>
                        <option value="U-PRO">U-PRO</option>

                      </select>
                    </div>
                    <div class="form-group col-6">
                    <label for="current_plan_price">Price of Current Plan</label>
                      <input id="crtPlanPrice" type="number" placeholder="e.g. 35000" class="form-control" name="current_plan_price" autofocus required>
                    </div>
                  </div>

                <!-- Row 5 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="requested_new_plan">Requested New Plan</label>
                      <select class="form-control" id="reqNewPlan" name="req_new_plan" required>
                        <option disabled="disabled" selected="selected">Select Plan</option>
                        <option disabled="disabled">Home/Residential Unlimited Plan</option>

                        <option value="H-LITE Unlimited">H-LITE Unlimited</option>
                        <option value="H-MAX Unlimited">H-MAX Unlimited</option>
                        <option value="H-PRO Unlimited">H-PRO Unlimited</option>
                        
                        <option disabled="disabled">SME's Unlimited Plan</option>
                        <option value="U-LITE">U-LITE</option>
                        <option value="U-MAX">U-MAX</option>
                        <option value="U-PRO">U-PRO</option>

                      </select>
                    </div>
                    <div class="form-group col-6">
                    <label for="new_plan_price">Price of New Plan</label>
                      <input id="newPlanPrice" type="number" placeholder="e.g. 35000" class="form-control" name="new_plan_price" autofocus required>
                    </div>
                  </div>
                  
                  <!-- Row 6 -->
                  <div class="row">
                  <div class="form-group col-6">
                      <label>Date of Change</label>
                      <input id="changeDate" type="date" class="form-control" name="change_date" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label>Change Requested by:</label>
                      <input id="changeReqBy" type="text" class="form-control" name="change_req_by" autofocus required>
                    </div>
                  </div>

                  <!-- Row 7-->
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Remarks <span style="font-size: 8px !important;"> (Enter any other useful information here)</span></label>
                      <textarea class="form-control" id="remarks" name="remarks" row="3" col="3" autofocus></textarea>
                    </div>
                  </div>


                  <!-- <div class="form-group">
                    <label for="email">User ID</label>
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div> -->

                  <div class="form-group">
                    <button type="submit" name="create-change-order-form" class="btn btn-primary btn-block">
                      Submit Form
                    </button>
                  </div>
                </form>
                
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
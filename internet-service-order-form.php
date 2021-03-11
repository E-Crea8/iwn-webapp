<?php
 include ('./controllers/functions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="./dist/img/favicon.fw.png">
  <title>I-World Networks - Internet Service Order Form</title>

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
            <div>Internet Service Order Form<br>
        <span style="font-size:12px; font-weight:normal; color:#FF0000;">Kindly fill all the fields</span></div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <!-- <div class="alert alert-info mb-0">
                  We use 'Toastr' made by @CodeSeven. You can check the full documentation <a href="http://www.toastrjs.com/">here</a>.
                </div> -->
                <?php
                if(isset($_POST['create-ip-order-form'])){
                  createInternetServiceOrderForm(); //here goes the function call
               }
               ?>



                <form name="create-ip-order-form" method="POST">

                <div class="form-header-label">Client Information</div>
                <!-- Row 1 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="first_name">Name of Organization/Client</label>
                      <input id="f_name" type="text" class="form-control" name="f_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="home_address">Business/Home Address</label>
                    <textarea class="form-control" id="homeAddress" name="h_address" row="3" col="3" autofocus required></textarea>
                    </div>
                  </div>

                <!-- Row 2 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="phone">Telephone Number</label>
                      <input id="phone" type="text" class="form-control" name="phone" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="email">Email Address</label>
                      <input id="email" type="email" class="form-control" name="email" autofocus required>
                    </div>
                  </div>

                  <!-- Row 3 -->
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Web Address</label>
                      <input id="webAddress" type="text" class="form-control" name="web_address" autofocus>
                    </div>
                  </div>

                  <div class="form-header-label">Contact Person Information (Technical)</div>
                <!-- Row 4 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="cp_name">Name</label>
                      <input id="cpName" type="text" class="form-control" name="cp_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="cp_phone">Mobile Number</label>
                      <input id="cpPhone" type="text" class="form-control" name="cp_phone" autofocus required>
                    </div>
                  </div>

                  <!-- Row 5 -->
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Email Address</label>
                      <input id="cpEmail" type="email" class="form-control" name="cp_email" autofocus required>
                    </div>
                  </div>
                  
                  <div class="form-header-label">Contact Person Information (Billing)</div>
                <!-- Row 6 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="cpb_name">Name</label>
                      <input id="cpbName" type="text" class="form-control" name="cpb_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="cpb_phone">Mobile Number</label>
                      <input id="cpbPhone" type="text" class="form-control" name="cpb_phone" autofocus required>
                    </div>
                  </div>

                  <!-- Row 7 -->
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Email Address</label>
                      <input id="cpbEmail" type="email" class="form-control" name="cpb_email" autofocus required>
                    </div>
                  </div>

                  <div class="form-header-label">Choose Subscription Plan</div>
                <!-- Row 8 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="plan">Subscription Plan</label>
                      <select class="form-control" id="subPlan" name="plan" required>
                        <option disabled="disabled" selected="selected">Choose a Plan</option>
                        <option disabled="disabled" selected="selected">Home/Residential Unlimited Plan</option>

                        <option value="H-LITE Unlimited (₦18,275)">H-LITE Unlimited (₦18,275)</option>
                        <option value="H-MAX Unlimited (₦26,875)">H-MAX Unlimited (₦26,875)</option>
                        <option value="H-PRO Unlimited (₦32,250)">H-PRO Unlimited (₦32,250)</option>
                        
                        <option disabled="disabled" selected="selected">SME's Unlimited Plan</option>
                        <option value="U-LITE (₦21,500)">U-LITE (₦21,500)</option>
                        <option value="U-MAX (₦32,250)">U-MAX (₦32,250)</option>
                        <option value="U-PRO (₦43,000)">U-PRO (₦43,000)</option>

                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="non_recurrent_cost">Non Recurrent Cost</label>
                      <input id="nonRecurrentCost" type="number" class="form-control" name="non_recurrent_cost" autofocus required>
                    </div>
                </div>

                  <!-- Row 9 -->
                  <div class="row">
                  <div class="form-group col-6">
                      <label for="installation_date">Site Survey/Installation Date</label>
                      <input id="installationDate" type="date" class="form-control" name="installation_date" autofocus required>
                    </div>
                  
                    <div class="form-group col-6">
                      <label>Official Use <span style="font-size: 8px !important;"> (Enter any other useful information here)</span></label>
                      <textarea class="form-control" id="officialInfo" name="official_info" row="3" col="3" autofocus required></textarea>
                    </div>
                  </div>


                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="create-ip-order-form" class="btn btn-primary btn-block">
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
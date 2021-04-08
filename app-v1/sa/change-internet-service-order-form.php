<?php
 include ('./app-controller/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="../../dist/img/favicon.fw.png">

  <title>IWN App - Internet Service Change Order Form</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="../dist/modules/summernote/summernote-lite.css">
  <link rel="stylesheet" href="../dist/modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="../assets/sweetalert/css/sweetalert2.min.css">

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="ion ion-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><i class="ion ion-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion ion-ios-bell-outline"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">View All</a>
                </div>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <i class="ion ion-android-person d-lg-none"></i>
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo getUserName($id_session); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="profile" class="dropdown-item has-icon">
                <i class="ion ion-android-person"></i> Profile
              </a>
              <a href="#" id="logout" class="dropdown-item has-icon">
                <i class="ion ion-log-out"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- Sidebar Menus -->
      <?php include ('./app-controller/sidebar.php'); ?>
      <!-- End Sidebar Menus -->


      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Create Change Order Form For Internet Service</div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <?php
                if(isset($_POST['create-change-order-form'])){
                    createInternetChangeOrderForm(); //here goes the function call
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
                      <textarea class="form-control" id="remarks" name="remarks" row="3" col="3" autofocus required></textarea>
                    </div>
                  </div>


                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

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
      <footer class="main-footer">
        <div class="footer-left">
        <?php
              logoutText();
        ?>
        </div>
        <div class="footer-right"></div>
      </footer>
    </div>
  </div>


  <!-- Sweet Alert -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../assets/sweetalert/js/sweetalert2.min.js"></script>

  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  
  <script src="../dist/modules/chart.min.js"></script>
  <script src="../dist/modules/summernote/summernote-lite.js"></script>

  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <!-- <script src="../dist/js/demo.js"></script> -->

<!--Logout Sweet Alert -->
<script type="text/javascript">
        $(document).ready(function(){
            $("#logout").click(function(){

              swal.fire({
                      title: 'Confirm Logout!',
                      text: "Are you sure you want to logout of the application?",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, log me out!'                    
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = "logout.php";
                        Swal.fire(
                          'Success!',
                          'You have been logged out successfully.',
                          'success'
                        )
                      }
                    })

            });
        });
    </script>


<script type="text/javascript">
        $(document).ready(function(){
            $("#sidebarLogout").click(function(){

                    swal.fire({
                      title: 'Confirm Logout!',
                      text: "Are you sure you want to logout of the application",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, log me out!'                    
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = "logout.php";
                        Swal.fire(
                          'Success!',
                          'You have been logout successfully.',
                          'success'
                        )
                      }
                    })

            });
        });
    </script>

    <script>
        $( "#changeDate" ).datepicker({
    dateFormat : 'dd-mm-yy'
});
    </script>

</body>
</html>
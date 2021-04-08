<?php
 include ('./app-controller/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="./../dist/img/favicon.fw.png">

  <title>IWN App - Installation Completion Certification Form</title>

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
            <div>Create Installation Completion Certification Form</div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <?php
                if(isset($_POST['create-installation-completion-form'])){
                    createInstallationCompletionForm(); //here goes the function call
               }
               ?>



                <form name="create-ip-order-form" method="POST">

                <div class="form-header-label">Customer Details</div>
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
                    <div class="form-group col-12">
                      <label for="customer_sub_details">Customer Subscription Details</label>
                      <textarea class="form-control" id="customerSubDetails" name="customer_sub_details" row="3" col="3" autofocus required></textarea>
                    </div>
                  </div>


                  <div class="form-header-label">Equipment Details</div>
                <!-- Row 3 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="station_radio_type">Type of Station Radio with MAC</label>
                      <input id="stationRadioType" type="text" class="form-control" name="station_radio_type" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="router_type">Type of Router with MAC</label>
                    <input id="routerType" type="text" class="form-control" name="router_type" autofocus required>
                    </div>
                  </div>


                <!-- Row 4 -->
                <div class="row">
                    <div class="form-group col-12">
                      <label for="installation_type">Type of Installation</label>
                      <input id="installationType" type="text" class="form-control" name="installation_type" autofocus required>
                    </div>
                  </div>


                <!-- Row 5 -->
                <div class="form-header-label">Power Status</div>
                <div class="row">
                <div class="form-group col-6">
                    <label for="surge_protector_available">Type of Surge Protector Available On Site</label>
                      <input id="surgeProtectorAvailable" type="text" class="form-control" name="surge_protector_available" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="power_backup_available">Type of Power Backup Available On Site</label>
                      <input id="powerBackupAvailable" type="text" class="form-control" name="power_backup_available" autofocus required>
                    </div>
                </div>


                <!-- Row 6 -->
                <div class="form-header-label">Installation Baseline Parameter</div>
                <div class="row">
                <div class="form-group col-6">
                    <label for="associated_ap">Associated AP</label>
                      <input id="associatedAP" type="text" class="form-control" name="associated_ap" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="signal_level">Signal Level</label>
                      <input id="signalLevel" type="text" class="form-control" name="signal_level" autofocus required>
                    </div>
                </div>

                <!-- Row 7 -->
                <div class="row">
                <div class="form-group col-12">
                    <label for="link_ccq">Link CCQ</label>
                      <input id="linkCCQ" type="text" class="form-control" name="link_ccq" autofocus required>
                    </div>
                </div>

                <!-- Row 8 -->
                <div class="form-header-label">Radio Capacity</div>
                <div class="row">
                <div class="form-group col-6">
                    <label for="tx">TX</label>
                      <input id="tx" type="text" class="form-control" name="tx" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="rx">RX</label>
                      <input id="rx" type="text" class="form-control" name="rx" autofocus required>
                    </div>
                </div>


                <!-- Row 9 -->
                <div class="form-header-label">Speed Test</div>
                <div class="row">
                <div class="form-group col-6">
                    <label for="downlink">Downlink</label>
                      <input id="downlink" type="text" class="form-control" name="downlink" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="uplink">Uplink</label>
                      <input id="uplink" type="text" class="form-control" name="uplink" autofocus required>
                    </div>
                </div>


                <!-- Row 10 -->
                <div class="row">
                <div class="form-group col-12">
                    <label for="lan_speed">LAN Speed</label>
                      <input id="lanSpeed" type="text" class="form-control" name="lan_speed" autofocus required>
                    </div>
                </div>

                <!-- Row 11 -->
                <div class="form-header-label">User Onboarding Process Check List</div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="lan_speed">Is Customer Account Portal Activated?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="customerPortalCheckbox1" name="customer_portal_activation_status" value="Yes">
                        <label class="form-check-label" for="customerPortalCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="customerPortalCheckbox2" name="customer_portal_activation_status" value="No">
                        <label class="form-check-label" for="customerPortalCheckbox2">No</label>
                    </div>
                </div>
            </div>
            

                <hr size="2" style="color: #F6F6F6; " />

            <div class="row">
                <div class="form-group col-12">
                    <label for="lan_speed">Has the customer been enlightened on how to make use of the account portal to pay invoice, check his usage, send email for support request, etc.?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="customerTrainingCheckbox1" name="customer_training_status" value="Yes">
                        <label class="form-check-label" for="customerTrainingCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="customerTrainingCheckbox2" name="customer_training_status" value="No">
                        <label class="form-check-label" for="customerTrainingCheckbox2">No</label>
                    </div>
                </div>
            </div>


            <hr size="2" style="color: #F6F6F6; " />

            <div class="row">
                <div class="form-group col-12">
                    <label for="lan_speed">Is the wireless app management of the router installed for customer?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="appMgtCheckbox1" name="app_mgt_status" value="Yes">
                        <label class="form-check-label" for="appMgtCheckbox1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="appMgtCheckbox2" name="app_mgt_status" value="No">
                        <label class="form-check-label" for="appMgtCheckbox2">No</label>
                    </div>
                </div>
            </div>


            <hr size="2" style="color: #F6F6F6; " />

            <div class="row">
                <div class="form-group col-12">
                    <label for="lan_speed">Can the customer change his/her wireless password?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="passwordChange1" name="password_change_status" value="Yes">
                        <label class="form-check-label" for="passwordChange1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="passwordChange2" name="password_change_status" value="No">
                        <label class="form-check-label" for="passwordChange2">No</label>
                    </div>
                </div>
            </div>


                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="create-installation-completion-form" class="btn btn-primary btn-block">
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

</body>
</html>
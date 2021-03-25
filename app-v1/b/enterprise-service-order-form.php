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

  <title>IWN App - Enterprise Service Order Form</title>

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
            <div>Create Enterprise Service Order Form</div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <!-- <div class="alert alert-info mb-0">
                  We use 'Toastr' made by @CodeSeven. You can check the full documentation <a href="http://www.toastrjs.com/">here</a>.
                </div> -->
                <?php
                if(isset($_POST['create-enterprise-order-form'])){
                  createEnterpriseServiceOrderForm(); //here goes the function call
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
                      <input id="plan" type="text" class="form-control" name="plan" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="bandwidth_cost">Bandwidth Cost</label>
                      <input id="bandwidthCost" type="number" class="form-control" name="bandwidth_cost" autofocus required>
                    </div>
                </div>

                  <!-- Row 9 -->
                  <div class="row">
                  <div class="form-group col-6">
                      <label for="non_recurrent_cost">Non Recurrent Cost</label>
                      <input id="nonRecurrentCost" type="number" class="form-control" name="non_recurrent_cost" autofocus required>
                    </div>
                  
                  <div class="form-group col-6">
                      <label for="installation_date">Site Survey/Installation Date</label>
                      <input id="installationDate" type="date" class="form-control" name="installation_date" autofocus required>
                    </div>
                  
                </div>

                  <!-- Row 10 -->
                  <div class="row">
                 
                    <div class="form-group col-12">
                      <label>Official Use <span style="font-size: 8px !important;"> (Enter any other useful information here)</span></label>
                      <textarea class="form-control" id="officialInfo" name="official_info" row="3" col="3" autofocus required></textarea>
                    </div>
                  </div>


                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="create-enterprise-order-form" class="btn btn-primary btn-block">
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
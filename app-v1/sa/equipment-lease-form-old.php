<?php
 include ('./app-controller/functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    name="viewport">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="../../dist/img/favicon.fw.png">

  <title>IWN App - Equipment Lease Form</title>

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
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a>
            </li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                  class="ion ion-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><i class="ion ion-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg beep"><i class="ion ion-ios-bell-outline"></i></a>
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
              <div class="d-sm-none d-lg-inline-block">Hi, <?php echo getUserName($id_session); ?></div>
            </a>
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
            <div>Create Equipment Lease Form</div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <!-- <div class="alert alert-info mb-0">
                  We use 'Toastr' made by @CodeSeven. You can check the full documentation <a href="http://www.toastrjs.com/">here</a>.
                </div> -->
                <?php
                if(isset($_POST['create-equipment-lease-form'])){
                  createEquipmentLeaseForm(); //here goes the function call
               }
               ?>



                <form name="create-ip-order-form" method="POST">

                  <div class="form-header-label">Client Details</div>
                  <!-- Row 1 -->
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="client_name">Client's Name</label>
                      <input id="clientsName" type="text" class="form-control" name="client_name" autofocus required>
                    </div>
                    <!-- <div class="form-group col-6">
                    <label for="home_address">Business/Home Address</label>
                    <textarea class="form-control" id="homeAddress" name="h_address" row="3" col="3" autofocus required></textarea>
                    </div> -->
                  </div>


                  <div class="form-header-label">Customer Primary Details</div>
                  <!-- Row 2 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="title">Title</label>
                      <select class="form-control" id="title" name="title" required>
                        <option disabled="disabled" selected="selected">Select a Title</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Engr.">Engr.</option>
                        <option value="Chief">Chief</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="contact_person">Contact Person</label>
                      <input id="contactPerson" type="text" class="form-control" name="customer_name" autofocus
                        required>
                    </div>
                  </div>

                  <!-- Row 3 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Telephone Number</label>
                      <input id="telephoneNumber" type="text" class="form-control" name="phone" autofocus required>
                    </div>

                    <div class="form-group col-6">
                      <label>Email Address</label>
                      <input id="email" type="email" class="form-control" name="email" autofocus required>
                    </div>
                  </div>

                  <!-- Row 4 -->
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Address</label>
                      <textarea class="form-control" id="address" name="address" row="3" col="3" autofocus
                        required></textarea>
                    </div>
                  </div>


                  <div class="form-header-label">Device Details</div>
                  <!-- Row 5 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="device_model_1">Device Model 1</label>
                      <select class="form-control" id="devModel1" name="device_model_1">
                        <option disabled="disabled" selected="selected">Select Model</option>
                        <option value="Litebeam">Litebeam</option>
                        <option value="Litebeam AC">Litebeam AC</option>
                        <option value="Powerbeam M5 400">Powerbeam M5 400</option>
                        <option value="Powerbeam 5AC Gen2">Powerbeam 5AC Gen2</option>
                        <option value="Nanobeam">Nanobeam</option>
                        <option value="Nanobeam AC">Nanobeam AC</option>
                        <option value="Nanostation M5">Nanostation M5</option>
                        <option value="Nanostation M2">Nanostation M2</option>
                        <option value="Mikrotik 750g">Mikrotik 750g</option>
                        <option value="Mikrotik 2011">Mikrotik 2011</option>
                        <option value="5 Port Switch">5 Port Switch</option>
                        <option value="8 Port Switch">8 Port Switch</option>
                        <option value="16 Port Switch">16 Port Switch</option>
                        <option value="24 Port Switch">24 Port Switch</option>
                        <option value="D-Link">D-Link</option>
                        <option value="TP-Link">TP-Link</option>
                        <option value="Aircube">Aircube</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="dev_mac_add_1">Device Mac Address 1</label>
                      <input id="devMacAdd1" type="text" class="form-control" name="mac_add_1" autofocus>
                    </div>
                  </div>

                  <!-- Row 6 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="device_model_2">Device Model 2</label>
                      <select class="form-control" id="devModel1" name="device_model_2">
                        <option disabled="disabled" selected="selected">Select Model</option>
                        <option value="Litebeam">Litebeam</option>
                        <option value="Litebeam AC">Litebeam AC</option>
                        <option value="Powerbeam M5 400">Powerbeam M5 400</option>
                        <option value="Powerbeam 5AC Gen2">Powerbeam 5AC Gen2</option>
                        <option value="Nanobeam">Nanobeam</option>
                        <option value="Nanobeam AC">Nanobeam AC</option>
                        <option value="Nanostation M5">Nanostation M5</option>
                        <option value="Nanostation M2">Nanostation M2</option>
                        <option value="Mikrotik 750g">Mikrotik 750g</option>
                        <option value="Mikrotik 2011">Mikrotik 2011</option>
                        <option value="5 Port Switch">5 Port Switch</option>
                        <option value="8 Port Switch">8 Port Switch</option>
                        <option value="16 Port Switch">16 Port Switch</option>
                        <option value="24 Port Switch">24 Port Switch</option>
                        <option value="D-Link">D-Link</option>
                        <option value="TP-Link">TP-Link</option>
                        <option value="Aircube">Aircube</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="dev_mac_add_2">Device Mac Address 2</label>
                      <input id="devMacAdd2" type="text" class="form-control" name="mac_add_2" autofocus>
                    </div>
                  </div>
                  <!-- Row 7 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="device_model_3">Device Model 3</label>
                      <select class="form-control" id="devModel1" name="device_model_3">
                        <option disabled="disabled" selected="selected">Select Model</option>
                        <option value="Litebeam">Litebeam</option>
                        <option value="Litebeam AC">Litebeam AC</option>
                        <option value="Powerbeam M5 400">Powerbeam M5 400</option>
                        <option value="Powerbeam 5AC Gen2">Powerbeam 5AC Gen2</option>
                        <option value="Nanobeam">Nanobeam</option>
                        <option value="Nanobeam AC">Nanobeam AC</option>
                        <option value="Nanostation M5">Nanostation M5</option>
                        <option value="Nanostation M2">Nanostation M2</option>
                        <option value="Mikrotik 750g">Mikrotik 750g</option>
                        <option value="Mikrotik 2011">Mikrotik 2011</option>
                        <option value="5 Port Switch">5 Port Switch</option>
                        <option value="8 Port Switch">8 Port Switch</option>
                        <option value="16 Port Switch">16 Port Switch</option>
                        <option value="24 Port Switch">24 Port Switch</option>
                        <option value="D-Link">D-Link</option>
                        <option value="TP-Link">TP-Link</option>
                        <option value="Aircube">Aircube</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="dev_mac_add_3">Device Mac Address 3</label>
                      <input id="devMacAdd3" type="text" class="form-control" name="mac_add_3" autofocus>
                    </div>
                  </div>

                  <!-- Row 8 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="device_model_4">Device Model 4</label>
                      <select class="form-control" id="devModel1" name="device_model_4">
                        <option disabled="disabled" selected="selected">Select Model</option>
                        <option value="Litebeam">Litebeam</option>
                        <option value="Litebeam AC">Litebeam AC</option>
                        <option value="Powerbeam M5 400">Powerbeam M5 400</option>
                        <option value="Powerbeam 5AC Gen2">Powerbeam 5AC Gen2</option>
                        <option value="Nanobeam">Nanobeam</option>
                        <option value="Nanobeam AC">Nanobeam AC</option>
                        <option value="Nanostation M5">Nanostation M5</option>
                        <option value="Nanostation M2">Nanostation M2</option>
                        <option value="Mikrotik 750g">Mikrotik 750g</option>
                        <option value="Mikrotik 2011">Mikrotik 2011</option>
                        <option value="5 Port Switch">5 Port Switch</option>
                        <option value="8 Port Switch">8 Port Switch</option>
                        <option value="16 Port Switch">16 Port Switch</option>
                        <option value="24 Port Switch">24 Port Switch</option>
                        <option value="D-Link">D-Link</option>
                        <option value="TP-Link">TP-Link</option>
                        <option value="Aircube">Aircube</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="dev_mac_add_4">Device Mac Address 4</label>
                      <input id="devMacAdd4" type="text" class="form-control" name="mac_add_4" autofocus>
                    </div>
                  </div>

                  <div class="form-header-label">Date & Witness Details</div>
                  <!-- Row 9 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="agreement_date">Agreement Date</label>
                      <input id="agreementDate" type="date" class="form-control" name="agreement_date" autofocus
                        required>
                    </div>

                    <div class="form-group col-6">
                      <label>Witness Name</label>
                      <input id="witnessName" type="text" class="form-control" name="witness_name" autofocus>
                    </div>
                  </div>


                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control"
                      name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="create-equipment-lease-form" class="btn btn-primary btn-block">
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
  $(document).ready(function() {
    $("#logout").click(function() {

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
            'You have been logout successfully.',
            'success'
          )
        }
      })

    });
  });
  </script>


  <script type="text/javascript">
  $(document).ready(function() {
    $("#sidebarLogout").click(function() {

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
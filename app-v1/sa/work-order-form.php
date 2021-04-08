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

  <title>IWN App - Work Order Form</title>

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
            <div>Create Work Order Form</div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <?php
                if(isset($_POST['create-work-order-form'])){
                  createWorkOrderForm(); //here goes the function call
               }
               ?>



                <form name="create-ip-order-form" method="POST">

                <div class="form-header-label">Project Details</div>
                <!-- Row 1 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="title">Title</label>
                      <select class="form-control" id="title" name="title" required>
                        <option disabled="disabled" selected="selected">Choose a Title</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Engr.">Engr.</option>
                        <option value="Tech">Tech</option>

                      </select>
                    </div>
                    <div class="form-group col-6">
                    <label for="start_date">Start Date</label>
                    <input id="startDate" type="date" class="form-control" name="start_date" step="1" autofocus required>
                    </div>
                  </div>

                <!-- Row 2 -->
                <div class="row">
                <div class="form-group col-6">
                    <label for="delivery_date">Delivery Date</label>
                    <input id="deliveryDate" type="date" class="form-control" name="delivery_date" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="project_overview">Project Overview</label>
                    <textarea class="form-control" id="projectOverview" name="project_overview" row="3" col="3" autofocus required placeholder="Provide the summary of the tasks"></textarea>
                    </div>
                  </div>

                  <!-- Row 3 -->
                  <div class="row">
                  <div class="form-group col-6">
                    <label for="required_tools">Required Tools and Accessories</label>
                    <textarea class="form-control" id="requiredTools" name="required_tools" row="3" col="3" autofocus required placeholder="Provide information of the tools and accessories needed by the techs to carry out the particular task."></textarea>
                    </div>
                    <div class="form-group col-6">
                    <label for="standard_instruction">Standard Instructions</label>
                    <textarea class="form-control" id="standardInstruction" name="standard_instruction" row="3" col="3" autofocus required placeholder="Provide details of what the project is all about in terms of the peculiarity of the customer requirement."></textarea>
                    </div>
                  </div>

                  <!-- <div class="form-header-label">Contact Person Information (Technical)</div> -->
                <!-- Row 4 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="budget_url">Link Budget & Installation Design URL </label>
                      <input id="budgetUrl" type="text" class="form-control" name="budget_url" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="installation_report_url">Installation Report URL</label>
                      <input id="installationReportUrl" type="text" class="form-control" name="installation_report_url" autofocus required>
                    </div>
                  </div>

                  <!-- Row 5 -->
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Equipment Pick Up time <span style="font-size: 8px !important;"> (choose a time stamp)</span></label>
                      <input id="pickUpTime" type="time" class="form-control" name="pick_up_time" autofocus required>
                    </div>
                  </div>
                  
                  <!-- Row 6 Heading -->
                  <div class="form-header-label">Task Checklist</div>
                  <div style="margin-left: 30px !important;">PRE-VISIT</div>
                <!-- Row 6 -->
                <div class="row" style="padding-left:30px !important;">
                <div class="form-group  col-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pre_visit[]" value="Review of Work Order with Project Manager" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      Review of Work Order with Project Manager
                    </label>
                    </div>


                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pre_visit[]" value="Equipment Pickup" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                      Equipment Pickup
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pre_visit[]" value="Testing of Equipment (Used or Retrieved)" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">
                      Testing of Equipment (Used or Retrieved)
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pre_visit[]" value="Purchase of Accessories" id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">
                      Purchase of Accessories
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pre_visit[]" value="Announce ETA to the Project Manager (PM)" id="defaultCheck5">
                    <label class="form-check-label" for="defaultCheck5">
                      Announce ETA to the Project Manager (PM)
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pre_visit[]" value="Covid-19 Compliant (Face Mask & Hand Sanitizer and Social Distance)" id="defaultCheck6">
                    <label class="form-check-label" for="defaultCheck6">
                      Covid-19 Compliant (Face Mask & Hand Sanitizer and Social Distance)
                    </label>
                    </div>

                    </div>


                  <!-- Check list 2 -->
                    <div class="form-group col-6" style="margin-top: -20px !important;">
                    <div >ON SITE</div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Check in with the Project Manager" id="defaultCheck7">
                    <label class="form-check-label" for="defaultCheck7">
                    Check in with the Project Manager 
                    </label>
                    </div>


                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Upload ODU Installation Pictures" id="defaultCheck8">
                    <label class="form-check-label" for="defaultCheck8">
                      Upload ODU Installation Pictures
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Upload RF Parameters" id="defaultCheck9">
                    <label class="form-check-label" for="defaultCheck9">
                      Upload RF Parameters
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Get approval to proceed from the PM" id="defaultCheck10">
                    <label class="form-check-label" for="defaultCheck10">
                      Get approval to proceed from the PM
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Upload cable run pictures" id="defaultCheck11">
                    <label class="form-check-label" for="defaultCheck11">
                      Upload cable run pictures
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Upload demark Point Pictures" id="defaultCheck12">
                    <label class="form-check-label" for="defaultCheck12">
                      Upload demark Point Pictures
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Upload to IDU Pictures" id="defaultCheck13">
                    <label class="form-check-label" for="defaultCheck13">
                      Upload to IDU Pictures
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Get Approval to proceed to Activation (Call for IP address)" id="defaultCheck14">
                    <label class="form-check-label" for="defaultCheck14">
                      Get Approval to proceed to Activation (Call for IP address)
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Upload Speed Test Pictures" id="defaultCheck15">
                    <label class="form-check-label" for="defaultCheck15">
                      Upload Speed Test Pictures
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="UUpload client EUP activation" id="defaultCheck15">
                    <label class="form-check-label" for="defaultCheck15">
                      UUpload client EUP activation
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Upload the Clients Signed Completed JCC" id="defaultCheck16">
                    <label class="form-check-label" for="defaultCheck16">
                      Upload the Clients Signed Completed JCC
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="on_site[]" value="Check out of Site with the Project Manager " id="defaultCheck17">
                    <label class="form-check-label" for="defaultCheck17">
                      Check out of Site with the Project Manager 
                    </label>
                    </div>

                    </div>
                  </div>


                  <div class="form-header-label">Fees</div>
                  <!-- Row 7 -->
                  <div class="row">
                  <div class="form-group col-6">
                      <label>Materials &amp; Accessories</label>
                      <input id="materialAccessories" type="number" class="form-control" name="material_accessories_fee" autofocus required>
                    </div>

                    <div class="form-group col-6">
                      <label>Work order Fee</label>
                      <input id="workOrderFee" type="number" class="form-control" name="work_order_fee" autofocus required>
                    </div>
                  </div>

                  <div class="form-header-label">Project Manager Details</div>
                <!-- Row 8 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Name</label>
                      <input id="pmName" type="text" class="form-control" name="pm_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="pm_phone">Phone Number</label>
                      <input id="pmPhone" type="text" class="form-control" name="pm_phone" autofocus required>
                    </div>
                </div>

                  <!-- Row 9 -->
                  <div class="row">
                  <div class="form-group col-6">
                      <label for="pm_email">Email Address</label>
                      <input id="pmEmail" type="email" class="form-control" name="pm_email" autofocus required>
                    </div>
                  
                    <div class="form-group col-6">
                    <label for="pm_whatsapp">WhatsApp</label>
                      <input id="pmWhatsapp" type="text" class="form-control" name="pm_whatsapp" autofocus required>
                    </div>
                  </div>


                  <!-- Row 10 -->
                  <div class="row">
                  <div class="form-group col-12">
                      <label for="approved_by">Approved By</label>
                      <input id="approvedBy" type="text" class="form-control" name="approved_by" autofocus required>
                    </div>
                  </div>


                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="create-work-order-form" class="btn btn-primary btn-block">
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
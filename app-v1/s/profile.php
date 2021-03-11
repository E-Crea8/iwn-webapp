<?php
// Functions
include ('./app-controller/functions.php');

// Connect to User Table in DB
$user_query = "SELECT * FROM users WHERE user_id='$id_session'";
$sqlQuery = mysqli_query($dbc, $user_query);

$row=mysqli_fetch_array($sqlQuery);
$userId = $row['user_id'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="../../dist/img/favicon.fw.png">

  <title>IWN App - User Profile</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="../dist/modules/summernote/summernote-lite.css">
  <link rel="stylesheet" href="../dist/modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="./assets/sweetalert/css/sweetalert2.min.css">

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
            <div>Manage Your Profile</div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <!-- <div class="alert alert-info mb-0">
                  We use 'Toastr' made by @CodeSeven. You can check the full documentation <a href="http://www.toastrjs.com/">here</a>.
                </div> -->
                <?php
                if(isset($_POST['update-profile'])){
                  updateUserProfile(); //here goes the function call
               }
               ?>


                <form name="update-user-profile" method="POST">

                <!-- <div class="form-header-label">Section A: Equipment Replacement</div> -->
                <!-- Row 1 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="firstname">Firstame</label>
                      <input id="firstame" type="text" value="<?php echo $row['firstname']; ?>" class="form-control" name="firstname" autofocus required>
                    </div>
                    <div class="form-group col-6">
                    <label for="lastname">Lastname</label>
                    <input class="form-control" id="lastname" value="<?php echo $row['lastname']; ?>" name="lastname" type="text" autofocus required>
                    </div>
                  </div>

                <!-- Row 2 -->
                <div class="row">
                    <div class="form-group col-6">
                    <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" value="<?php echo $row['email']; ?>" name="email" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="password">Password<span style="font-size: 8px;"> (You can set a new password here)</span></label>
                      <input id="password" type="password" class="form-control" value="<?php echo $row['normal_password']; ?>" name="password" autofocus required>
                    </div>
                  </div>


                <!-- Row 3 -->
                <div class="row">
                    <div class="form-group col-12">
                    <label for="position">Position</label>
                      <input id="position" type="position" class="form-control" value="<?php echo $row['position']; ?>" name="position" autofocus required readonly>
                    </div>
                  </div>

                  <!-- <div class="form-header-label">Section B: Account Manager's Details </div> -->
                <!-- Row 3 -->
                <!-- <div class="row">
                    <div class="form-group col-6">
                      <label for="acct_mgr_name">Account Manager's Name</label>
                      <input id="acctMgrName" type="text" class="form-control" name="acct_mgr_name" autofocus required>
                    </div>
                    <div class="form-group col-6">
                        <label for="acct_mgr_email">Account Manager's Email</label>
                        <input id="acctMgrEmail" type="email" class="form-control" name="acct_mgr_email" autofocus required>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="update-profile" class="btn btn-primary btn-block">
                      Update Profile
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
  <script src="./assets/sweetalert/js/sweetalert2.min.js"></script>

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
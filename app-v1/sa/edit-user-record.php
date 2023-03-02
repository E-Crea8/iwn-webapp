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
  <link rel="shortcut icon" href="./../dist/img/favicon.fw.png">

  <title>IWN App - Edit User Record</title>

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

      <?php
        // Get user id from URL
        $uID = $_GET['id'];

        // Decode User ID using the PHP base_64 decode function
        $getUser = base64_decode($uID);

        // Get users record data from users login table in database
        $getUserData = "SELECT * FROM users WHERE user_id = '$getUser'";

        $doGetUserData = mysqli_query($dbc, $getUserData);

        while($rows = mysqli_fetch_assoc($doGetUserData)){
          $firstName = $rows['firstname'];
          $lastName = $rows['lastname'];
          $email  = $rows['email'];
          $position  = $rows['position'];
          $department  = $rows['department'];
          $active_status  = $rows['active_status'];

        // Replace 1 and 0 figure here
          if ($active_status == 1){
            $userActiveStatus = 'Active';
          }else{
            $userActiveStatus = 'Not Active';

          }
      ?>

      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Edit User Record
              <br>
              <span style="font-size:11px; color:#FF0000;"> User Details</span>
            </div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <?php
                if(isset($_POST['update-user'])){
                  updateUserData(); //here goes the function call
               }
               ?>



                <form name="update-user-data" method="POST">

                  <div class="form-header-label">User Information</div>
                  <!-- Row 1 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="firstname">Firstname</label>
                      <input id="firstname" type="text" value="<?php echo $rows['firstname']; ?>" class="form-control"
                        name="firstname" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="lastname">Lastname</label>
                      <input id="lastname" type="text" value="<?php echo $rows['lastname']; ?>" class="form-control"
                        name="lastname" autofocus required>
                    </div>
                  </div>

                  <!-- Row 2 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" value="<?php echo $rows['email']; ?>" class="form-control"
                        name="email" autofocus required>
                    </div>

                    <div class="form-group col-6">
                      <label for="active_status">Active Status
                      </label>
                      <input id="active_status" type="text" class="form-control"
                        value="<?php echo $userActiveStatus; ?>" name="active_status" readonly="" autofocus>
                    </div>

                  </div>

                  <!-- Row 3 -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="Position">Position</label>
                      <select class="form-control" id="position" name="position" required>
                        <option selected="selected" value="<?php echo $rows['position']; ?>">
                          <?php echo $rows['position']; ?></option>
                        <option value="CTO">CTO</option>
                        <option value="Managing Director">Managing Director</option>
                        <option value="Business Manager">Business Manager</option>
                        <option value="Network Engineer">Network Engineer</option>
                        <option value="Customer Support">Customer Support</option>
                        <option value="Business Executive">Business Executive</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="department">Set User priviledge</label>
                      <select class="form-control" id="department" name="department" required>
                        <option selected="selected" value="<?php echo $rows['department']; ?>">
                          <?php echo $rows['department']; ?></option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="Business">Business</option>
                        <option value="Support">Support</option>
                      </select>
                    </div>
                  </div>



                  <div class="form-group">
                    <input type="hidden" name="user_id" value="<?php echo $getUser; ?>" class="form-control">
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control"
                      name="id_session">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="update-user" class="btn btn-primary btn-block">
                      Update User Data
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- END WHILE LOOP -->
      <?php
          } 
      ?>

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
  $(document).ready(function() {
    $("#sidebarLogout").click(function() {

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
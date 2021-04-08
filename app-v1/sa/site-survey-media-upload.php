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

  <title>IWN App - Site Survey Form</title>

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
            <div>Site Survey Form
            <br>
            <span style="font-size:11px; color:#FF0000;"> Upload Media (Pictures/Videos)</span>            
            </div>
          </h1>
          <div class="section-body">
            <div class="card">
              <div class="card-body">

              <?php
                if(isset($_POST['upload-media'])){
                  createSiteSurveyMediaUpload(); //here goes the function call
               }
               ?>

                <form name="create-site-survey-media-upload" method="POST" enctype="multipart/form-data" action="">

                <div class="form-header-label">Media Details</div>
                <!-- Row 1 -->
                <div class="row">
                    <div class="form-group col-6">
                      <label for="client_name">Name of Organization/Client</label>
                      <select class="form-control" name="client_name" required>
                      <option selected="selected" hidden>Select Organization/Client</option>

                          <?php
                          $i=0;
                          $selectClient = "SELECT * FROM site_survey_customer_details ORDER BY id DESC";
                          $doSelectClient = mysqli_query($dbc, $selectClient);
                  
                          while($row = mysqli_fetch_array($doSelectClient)) {
                            ?>

                          <option value="<?=$row["client_name"];?>"><?=$row["client_name"];?></option>
                          <?php
                          $i++;
                          }
                          ?>
                      </select>
                    </div>
                    <div class="form-group col-6">
                    <label for="address">Media Category</label>
                    <select class="form-control" id="mediaCat" name="category" required>
                        <option disabled="disabled" selected="selected">Select a Category</option>
                        <option value="Pictures of highest height">Pictures of highest height</option>
                        <option value="Pictures showing cabling route">Pictures showing cabling route</option>
                        <option value="Pictures of the link termination point ">Pictures of the link termination point </option>
                        
                        <option value="Pictures of the LOS (line of sight) while standing on the highest point">Pictures of the LOS (line of sight) while standing on the highest point</option>
                        <option value="Pictures or video of the entire building from a distance">Pictures or video of the entire building from a distance</option>
                        <option value="Pictures showing router positioning point ">Pictures showing router positioning point </option>

                      </select>
                    </div>
                  </div>

                <!-- Row 2 -->
                <div class="row">
                    <div class="form-group col-12">
                      <label for="coordinate">Select Media <span style="font-size: 8px !important;"> (File Formats: jpg, jpeg, png, mp4)</span></label>
                      <input type="file" class="form-control" id="file" name="file[]" multiple />                    
                    </div>

                  <div class="form-group">
                    <!-- <label for="email">User ID</label> -->
                    <input type="hidden" name="id_session" value="<?php echo $id_session; ?>" class="form-control" name="id_session">
                  </div>

                  <div class="form-group col-12">
                    <button type="submit" name="upload-media" class="btn btn-primary btn-block">
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
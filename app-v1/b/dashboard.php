<?php
 include ('./app-controller/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="../../dist/img/favicon.fw.png">

  <title>IWN App - Dashboard</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="../dist/modules/summernote/summernote-lite.css">
  <link rel="stylesheet" href="../dist/modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="../assets/sweetalert/css/sweetalert2.min.css">


<!-- Data Tables -->
<link rel="stylesheet" href="../modules/datatables/datatables.min.css">

<script src="../modules/datatables/datatables.min.js"></script>
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
            <div>Dashboard</div>
          </h1>
          <!-- <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                  <i class="ion ion-person"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Users</h4>
                  </div>
                  <div class="card-body">
                    <?php noOfUsers(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-danger">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>IP Order Form</h4>
                  </div>
                  <div class="card-body">
                    <?php noOfInternetServiceOrderForm(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-warning">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Change Order Form</h4>
                  </div>
                  <div class="card-body">
                  <?php noOfChangeOrderForm(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-success">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Lease Form</h4>
                  </div>
                  <div class="card-body">
                    47
                  </div>
                </div>
              </div>
            </div> 

          </div> -->

          <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                  <i class="ion ion-person"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Users</h4>
                  </div>
                  <div class="card-body">
                    <?php noOfUsers(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-danger">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>IP Order Form</h4>
                  </div>
                  <div class="card-body">
                    <?php noOfInternetServiceOrderForm(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-warning">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Change Order Form</h4>
                  </div>
                  <div class="card-body">
                  <?php noOfChangeOrderForm(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-success">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Lease Form</h4>
                  </div>
                  <div class="card-body">
                    47
                  </div>
                </div>
              </div>
            </div> 


              
          </div>

          <div class="row">
            <div class="col-lg-5 col-md-12 col-12 col-sm-12">
              <form method="post" class="needs-validation" novalidate="">
                <div class="card">
                  <div class="card-header">
                    <h4>Customer Form Short-links</h4>
                  </div>
                  <div class="card-body">
                    <!-- <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control" required>
                      <div class="invalid-feedback">
                        Please fill in the title
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Content</label>
                      <textarea class="summernote-simple"></textarea>
                    </div> -->
                    <div style="font-weight: 500;">Internet Service Order Form - <div style="margin-top: 10px;"><span style="background-color: #F7F7F7; padding: 10px; border-radius: 4px; padding: 8px; border: #F58634 1px solid; font-weight: normal;"> https://bit.ly/3bSXGWm </span></div></div>
                    <div style="font-weight: 500; margin-top: 20px;">Enterprise Internet Service Order Form - <div style="margin-top: 10px;"><span style="background-color: #F7F7F7; padding: 10px; border-radius: 4px; padding: 8px; border: #F58634 1px solid; font-weight: normal;"> https://bit.ly/3f7VdLf </span></div></div>          
                    <div style="font-weight: 500; margin-top: 20px;">Internet Service Change Order Form - <div style="margin-top: 10px;"><span style="background-color: #F7F7F7; padding: 10px; border-radius: 4px; padding: 8px; border: #F58634 1px solid; font-weight: normal;"> https://bit.ly/2NJg9MR </span></div></div> 
                    <div style="font-weight: 500; margin-top: 20px;">Equipment Lease Form -  - <div style="margin-top: 10px;"><span style="background-color: #F7F7F7; padding: 10px; border-radius: 4px; padding: 8px; border: #F58634 1px solid; font-weight: normal;"> https://bit.ly/3bcHHUf </span></div></div> 
                    <div style="font-weight: 500; margin-top: 20px;">Equipment Retrieval Form -  <div style="margin-top: 10px;"><span style="background-color: #F7F7F7; padding: 10px; border-radius: 4px; padding: 8px; border: #F58634 1px solid; font-weight: normal;"> Coming Soon! </span></div></div> 
                </div>
            </div>
              </form>
            </div>
            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <!-- <div class="float-right">
                    <a href="#" class="btn btn-primary">View All</a>
                  </div> -->
                  <h4>BTS Locations & Coordinates</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                <table class="table table-striped" id="btsCoordinatesData">
                    <thead>
                        <tr>
                          <th>BTS Location</th>
                          <th>Latitude</th>
                          <th>Longtitude</th>
                        </tr>
                    </thead>
                      <!-- <tfoot>
                        <tr>
                          <th>BTS Location</th>
                          <th>Latitude</th>
                          <th>Longtitude</th>
                        </tr>
                      </tfoot> -->
                      <tbody> 
                      <tr>
                          <td>
                          ABANLA
                          </td>
                          <td>
                          7.222493
                          </td>
                          <td>
                          3.831718
                          </td>
                        </tr>
                        <tr>
                          <td>
                          AKARIGBO (SAGAMU)
                          </td>
                          <td>
                          6.85028337
                          </td>
                          <td>
                          3.65141639
                          </td>
                        </tr>
                        <tr>
                          <td>
                          DUGBE (OFFICE BTS)	
                          </td>
                          <td>
                          7.385914
                          </td>
                          <td>
                          3.881362
                          </td>
                        </tr>
                        <tr>
                          <td>
                          EPE
                          </td>
                          <td>
                          6.5878
                          </td>
                          <td>
                          3.94829
                          </td>
                        </tr>
                        <tr>
                          <td>
                          ELEGA
                          </td>
                          <td>
                          7.1967
                          </td>
                          <td>
                          3.3518
                          </td>
                        </tr>
                        <tr>
                          <td>
                          EWANG
                          </td>
                          <td>
                          7.1343666
                          </td>
                          <td>
                          3.3745722
                          </td>
                        </tr>   
                        <tr>
                          <td>
                          HENRY IJEBU
                          </td>
                          <td>
                          6.82916666
                          </td>
                          <td>
                          3.90111111
                          </td>
                        </tr>
                        <tr>
                          <td>
                          IJEBU ODE
                          </td>
                          <td>
                          6.82139
                          </td>
                          <td>
                          3.93722
                          </td>
                        </tr>
                        <tr>
                          <td>
                          IKIJA
                          </td>
                          <td>
                          7.2786
                          </td>
                          <td>
                          3.59906
                          </td>
                        </tr>
                        <tr>
                          <td>
                          IKORODU
                          </td>
                          <td>
                          6.64262
                          </td>
                          <td>
                          3.334447
                          </td>
                        </tr>
                        <tr>
                          <td>
                          IMPACT
                          </td>
                          <td>
                          7.42596
                          </td>
                          <td>
                          3.950338
                          </td>
                        </tr>
                        <tr>
                          <td>
                          INSPIRATION
                          </td>
                          <td>
                          7.40038
                          </td>
                          <td>
                          3.92497
                          </td>
                        </tr>
                        <tr>
                          <td>
                          IVD
                          </td>
                          <td>
                          7.12832
                          </td>
                          <td>
                          3.37434
                          </td>
                        </tr>
                      <tr>
                          <td>
                          LADERIN
                          </td>
                          <td>
                          7.124319
                          </td>
                          <td>
                          3.394838
                          </td>
                        </tr>
                        <tr>
                          <td>
                          MAGBORO
                          </td>
                          <td>
                          6.71420205	
                          </td>
                          <td>
                          3.41242767
                          </td>
                        </tr>
                        <tr>
                          <td>
                          MONIYA (R.NIGERIA)	
                          </td>
                          <td>
                          7.5227944
                          </td>
                          <td>
                          3.9111888
                          </td>
                        </tr>
                        <tr>
                          <td>
                          NTA
                          </td>
                          <td>
                          7.152873
                          </td>
                          <td>
                          3.335841
                          </td>
                        </tr>
                        <tr>
                          <td>
                          NTA IBADAN
                          </td>
                          <td>
                          7.39619
                          </td>
                          <td>
                          3.91765
                          </td>
                        </tr>
                        <tr>
                          <td>
                          OBADA
                          </td>
                          <td>
                          7.08396
                          </td>
                          <td>
                          3.29152
                          </td>
                        </tr>
                        <tr>
                          <td>
                          ODOGBOLU
                          </td>
                          <td>
                          6.8355
                          </td>
                          <td>
                          3.77461
                          </td>
                        </tr>
                        <tr>
                          <td>
                            OGBC
                          </td>
                          <td>
                          7.12587
                          </td>
                          <td>
                          3.33582
                          </td>
                        </tr>
                        <tr>
                          <td>
                          O HILL
                          </td>
                          <td>
                          7.125809
                          </td>
                          <td>
                          3.352042
                          </td>
                        </tr>
                        <tr>
                          <td>
                          OLOGUNERU
                          </td>
                          <td>
                          7.44121
                          </td>
                          <td>
                          3.82603
                          </td>
                        </tr>
                        <tr>
                          <td>
                          OMIDA
                          </td>
                          <td>
                          7.13955
                          </td>
                          <td>
                          3.33656
                          </td>
                        </tr>
                        <tr>
                          <td>
                          PARAMOUNT
                          </td>
                          <td>
                          7.103610
                          </td>
                          <td>
                          3.396360
                          </td>
                        </tr>
                        <tr>
                          <td>
                          PETALS
                          </td>
                          <td>
                          7.42588
                          </td>
                          <td>
                          3.911666
                          </td>
                        </tr>
                        <tr>
                          <td>
                          POTOKI
                          </td>
                          <td>
                          6.921278
                          </td>
                          <td>
                          3.534705
                          </td>
                        </tr>
                        <tr>
                          <td>
                          RADIO NIGERIA
                          </td>
                          <td>
                          7.387322222
                          </td>
                          <td>
                          3.8813083333
                          </td>
                        </tr>
                        <tr>
                          <td>
                          ROCK-CITY
                          </td>
                          <td>
                          7.17803
                          </td>
                          <td>
                          3.38317
                          </td>
                        </tr>
                        <tr>
                          <td>
                          ROYAL-ROOT
                          </td>
                          <td>
                          7.39488
                          </td>
                          <td>
                          3.86643
                          </td>
                        </tr>
                        <tr>
                          <td>
                          SAGAMU
                          </td>
                          <td>
                          6.8374
                          </td>
                          <td>
                          3.622243
                          </td>
                        </tr>
                        <tr>
                          <td>
                          SPACE
                          </td>
                          <td>
                          7.36575
                          </td>
                          <td>
                          3.86980
                          </td>
                        </tr>
                        <tr>
                          <td>
                          SPLASH
                          </td>
                          <td>
                          7.34473
                          </td>
                          <td>
                          3.88536
                          </td>
                        </tr>
                        <tr>
                          <td>
                          UPRIGHT
                          </td>
                          <td>
                          7.134517
                          </td>
                          <td>
                          3.319667
                          </td>
                        </tr>
                        <tr>
                          <td>
                          WFM
                          </td>
                          <td>
                          6.695975
                          </td>
                          <td>
                          3.423518
                          </td>
                        </tr>

                      </tbody>
              </table>
                  </div>
                </div>
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

<!-- Data Table JS -->
<script src="../modules/datatables/datatables.min.js"></script>

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

<!-- Data Table Script -->
<script>  
 $(document).ready(function(){  
      $('#btsCoordinatesData').DataTable();  
 });  
 </script>  

</body>
</html>
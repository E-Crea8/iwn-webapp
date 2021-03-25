<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard">I-World Networks</a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="../dist/img/avatar/avatar-user.jpg">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?php echo getUserName($id_session); ?> </div>
              <div class="user-role">
              <?php echo getUserPosition($id_session); ?>
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <!-- <li class="active"> -->
            <li>
              <a href="dashboard"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>



            <li class="menu-header">IAS Forms</li>

            <!-- IAS Menu Categories -->
            <li>
                          <a href="#" class="has-dropdown"><i class="ion ion-ios-home"></i><span>Site Survey Form</span></a>
                          <ul class="menu-dropdown">
                          <li><a href="site-survey-customer-details"><i class="ion ion-android-radio-button-on"></i> Customer Details</a></li>
                          <li><a href="site-survey-media-upload"><i class="ion ion-android-radio-button-on"></i> Media Uploads</a></li>
                          <li><a href="site-survey-record"><i class="ion ion-android-radio-button-on"></i> Manage Records</a></li>
                          </ul>
                        </li>
            <li>



            


            <li>
              <a href="#" id="sidebarLogout"><i class="ion ion-log-out"></i> Logout</a>
            </li>          </ul>
        </aside>
      </div>

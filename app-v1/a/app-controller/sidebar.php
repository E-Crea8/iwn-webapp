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



            <li class="menu-header">Internet and Equipment</li>

            <!-- Book Categories -->
            <li>
                          <a href="#" class="has-dropdown"><i class="ion ion-wifi"></i><span>Internet Service</span></a>
                          <ul class="menu-dropdown">
                          <li><a href="internet-service-order-form"><i class="ion ion-android-radio-button-on"></i> IP Order Form</a></li>
                          <li><a href="enterprise-service-order-form"><i class="ion ion-android-radio-button-on"></i> Enterprise Order Form</a></li>
                            <li><a href="change-internet-service-order-form"><i class="ion ion-android-radio-button-on"></i> Change Order Form</a></li>
                          </ul>
                        </li>
            <li>

            

            <!-- <li class="menu-header">Forms</li> -->

            <!-- Book Categories -->
            <li>
              <a href="#" class="has-dropdown"><i class="ion ion-ios-gear"></i><span>Equipments</span></a>
              <ul class="menu-dropdown">
                <li><a href="equipment-lease-form"><i class="ion ion-android-radio-button-on"></i> Lease Form</a></li>
                <li><a href="retrieval-form"><i class="ion ion-android-radio-button-on"></i> Retrieval Form</a></li>
                <li><a href="change-equipment-order-form"><i class="ion ion-android-radio-button-on"></i> Change Order Form</a></li>

              </ul>
            </li>

            <?php
            $linkMenu = "<a href=change-order-record><i class='ion ion-android-radio-button-on'></i>Change Order Record</a></li>";
            ?>

            <!-- Manage All Form Data -->
            <li>
              <a href="#" class="has-dropdown"><i class="ion ion-document-text"></i><span>Manage Records</span></a>
              <ul class="menu-dropdown">
                <li><a href="ip-order-form-record"><i class="ion ion-android-radio-button-on"></i>IP order Form Record</a></li>
                <li><a href="enterprise-order-record"><i class="ion ion-android-radio-button-on"></i> Enterprise Order Record</a></li>
                <li><?php echo $linkMenu; ?></li>
                <li><a href="equipment-lease-record"><i class="ion ion-android-radio-button-on"></i> Equipment Lease Record</a></li>
                <li><a href="equipment-retrieval-record"><i class="ion ion-android-radio-button-on"></i> Equipment Retrieval Record</a></li>
                <li><a href="equipment-change-record"><i class="ion ion-android-radio-button-on"></i> Equipment Change Record</a></li>
              </ul>
            </li>

              <!-- IAS Form Section -->

                          <li class="menu-header">IAS Forms</li>

            <li>
                          <a href="#" class="has-dropdown"><i class="ion ion-ios-gear"></i><span>Site Survey Form</span></a>
                          <ul class="menu-dropdown">
                          <li><a href="site-survey-customer-details"><i class="ion ion-android-radio-button-on"></i> Customer Details</a></li>
                          <li><a href="site-survey-media-upload"><i class="ion ion-android-radio-button-on"></i> Media Uploads</a></li>
                          <li><a href="other-info"><i class="ion ion-android-radio-button-on"></i> Other Info</a></li>
                          </ul>
                        </li>
            <li>



            <li>
              <a href="#" id="sidebarLogout"><i class="ion ion-log-out"></i> Logout</a>
            </li>          </ul>
          <!-- <div class="p-3 mt-4 mb-4">
            <a href="http://stisla.multinity.com/" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block">
              <i class="ion ion-help-buoy"></i> <div>Go PRO!</div>
            </a>
          </div> -->
        </aside>
      </div>

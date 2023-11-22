   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notif Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge">2</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>
            <a href="#" class="dropdown-item">
              <!-- Notif Start -->
              <div class="callout callout-info">
                <div class="media">
                  <img src="pics/lettuce.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Lettuce
                    </h3>
                    <p class="text-sm text-muted">High pH Level</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 1 min ago</p>
                  </div>
                </div>
              </div>
              <!-- Notif End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Notif Start -->
              <div class="callout callout-warning">
                <div class="media">
                  <img src="pics/spinach.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Water Spinach
                    </h3>
                    <p class="text-sm text-muted">Low pH Level</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 1 min ago</p>
                  </div>
                </div>
              </div>
              <!-- Notif End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Notif Start -->
              <div class="callout">
                <div class="media">
                  <img src="pics/swiss_chard.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Swiss Chard
                    </h3>
                    <p class="text-sm text-muted">Ready to Harvest</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 1 min ago</p>
                  </div>
                </div>
              </div>
              <!-- Notif End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Dark Mode -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="#">
          <i id="darkModeButton" i class="fa-regular fa-moon"></i>
        </a>
      </li>

      <?php
        include('../dbcon.php');

        $uid = $_SESSION['verified_user_id'];
        $user = $auth->getUser($uid);
        ?>


<li class="nav-item dropdown user user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <?php if ($user->photoUrl !== null) : ?>
            <img src="<?= $user->photoUrl ?>" class="user-image img-circle elevation-2" alt="User Image">
        <?php else : ?>
            <img src="dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
        <?php endif; ?>
        <span class="hidden-xs"><?= $user->displayName; ?></span>
    </a>




  <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <!-- User image -->
    <li class="user-header bg-primary">
    <?php if ($user->photoUrl !== null) : ?>
      <img src="<?=$user->photoUrl?>" class="img-circle elevation-2" alt="User Image">
      <?php else : ?>
      <img src="dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
      <?php endif; ?>
      <p>
        <?=$user->displayName;?>
        <small>Member since Nov. 2023</small>
      </p>
    </li>
    <!-- Menu Footer -->
    <li class="user-footer">
      <div class="text mt-3"> <!-- Use text-left class instead of pull-left -->
        <a href="my-profile.php" class="btn btn-default btn-flat">Profile</a>
        <a href="../logout.php " class="btn btn-default btn-flat float-right">Sign out</a>
      </div>
    </li>
  </ul>
</li>




  </ul>
  </nav>
      <!-- LOGOUT
      <li class="nav-item dropdown">
        <a class="nav-link" href="../logout.php">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      </li>
    </ul>
  </nav> -->
  <!-- /.navbar -->


 <!-- Main Sidebar Container -->
 <aside class="main-sidebar">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <br>
        <center><img src="pics/logo.png" alt="Logo" class="" style="height: 100px; width: 100px;">
          <h3 style="color: #2C3090; padding-top: 20px;">RLS-NES</h3>
        </center>
      </a>
      <br>

      <!-- Sidebar -->
      <div class="sidebar">


        <!-- SidebarSearch Form -->
        <!--   <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="fa-solid fa-gauge"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="plants.php" class="nav-link">
                <i class="fa-solid fa-seedling"></i>
                <p>Plants</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="history.php" class="nav-link">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <p>History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="report.php" class="nav-link">
                <i class="fa-solid fa-file-pen"></i>
                <p>Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="recommendation.php" class="nav-link">
                <i class="fa-solid fa-thumbs-up"></i>
                <p>Guidelines</p>
              </a>
            </li>
            <br>
            <li class="nav-header">USER</li>
            <li class="nav-item">
              <a href="user.php" class="nav-link">
                <i class="fa-solid fa-user-plus"></i>
                <p>
                  Manage Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="my-profile.php" class="nav-link">
                <i class="fa-solid fa-user-gear"></i>
                <p>
                  Account Settings
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


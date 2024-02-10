<style>
  /* Custom CSS to adjust the width of the notification dropdown */
  .dropdown-menu-lg {
    min-width: 300px; /* Adjust the width as needed */
  }
  .btn-default:hover {
    background-color: #007bff; /* Primary color on hover */
    color: #fff; /* Text color on hover */
  }
</style>

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
    <a id="notification-bell" class="nav-link mr-3" data-toggle="dropdown" href="#">
    <i class="fas fa-bell fa-2 mr-3 mt-2"></i>
      <span id="notification-count" class="badge badge-danger navbar-badge">0</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifications-container">
      <div class="dropdown-header bg-primary">
        Notifications
        <span class="float-right text-muted text-sm"></span>
      </div>
      <div id="notifications-list"></div>
      <a href="all_notification.php" class="dropdown-footer" style="text-align: center;">See All Messages</a>
    </div>
  </li>


      <?php
        include('../dbcon.php');

        $uid = $_SESSION['verified_user_id'];
        $user = $auth->getUser($uid);

        $userRecord = $auth->getUser($uid);

          // Get the user's creation timestamp
          $creationTimestamp = $userRecord->metadata->createdAt->getTimestamp();

          // Convert timestamp to a human-readable date
          $creationDate = date('M d, Y', $creationTimestamp);

        ?>


<li class="nav-item dropdown user user-menu mr-5">
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
        <small>Member since  <?=$creationDate;?></small>
      </p>
    </li>


    <li class="user-footer">
  <div class="text-center">
    <a href="my-profile.php" class="btn btn-default btn-flat">Profile</a><br>
    <a href="change-password.php?id=<?=$user->uid;?>" class="btn btn-default btn-flat">Change Password</a><br>
    <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
  </div>
</li>
  </ul>

</li>
  </ul>
  </nav>


 <!-- Main Sidebar Container -->
<aside class="main-sidebar">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-center">
    <br>
    <img src="pics/logo.png" alt="Logo" class="" style="height: 100px; width: 100px;">
    <h3 style="color: #2C3090; padding-top: 20px;">RLS-NES</h3>
  </a>
  <br>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
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
        <br>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warning"></i>
            <p>
              MAINTENANCE
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="plants_details.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>PLANTS DETAILS</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bay_nft.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>BAY AND NFT</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
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
    <i class="fas fa-bell mr-3 mt-2"></i>
      <span id="notification-count" class="badge badge-danger navbar-badge"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifications-container">
      <div class="dropdown-header bg-primary">
        Notifications
        <span class="float-right text-muted text-sm"></span>
      </div>
      <div id="notifications-list"></div>
      <a href="all_notification" class="dropdown-footer" style="text-align: center;">See All Messages</a>
    </div>
  </li>


      <?php
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

    <ul class="dropdown-menu dropdown-menu-right">
        <!-- User image and header -->
        <li class="user-header bg-primary">
            <?php if ($user->photoUrl !== null) : ?>
                <img src="<?= $user->photoUrl ?>" class="img-circle elevation-2" alt="User Image">
            <?php else : ?>
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            <?php endif; ?>
            <p>
                <?= $user->displayName; ?>
                <small>Member since <?= $creationDate; ?></small>
            </p>
        </li>
        <?php
        // Generate a unique token or hash for each user
        $token = hash('sha256', $user->uid); // You can use any hashing algorithm here
        ?>
        <!-- User footer with links -->
        <li class="user-footer">
            <div class="text-center">
                <a href="my-profile" class="btn btn-default btn-flat">Profile</a><br>
                <a href="change-password?token=<?= $token; ?>" class="btn btn-default btn-flat">Change Password</a><br>
                <a href="../logout" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>
    </ul>
</li>




  </ul>
  </nav>

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
                    <a href="./" class="nav-link">
                        <i class="fa-solid fa-gauge"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="plants" class="nav-link">
                        <i class="fa-solid fa-seedling"></i>
                        <p>Plants</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="activities" class="nav-link">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <p>Activities</p>
                    </a>
                </li>
                <?php
                // Redirect unauthorized users to another page
                $uid = $verifiedIdToken->claims()->get('sub');
                $claims = $auth->getUser($uid)->customClaims;
                if(isset($claims['admin']) == true){ ?>

                  <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-warning"></i>
                            <p> Maintenance</p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="plants_details" class="nav-link">
                                    <i class="far fa-circle"></i>
                                    <p>PLANTS DETAILS</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="bay_nft" class="nav-link">
                                    <i class="far fa-circle"></i>
                                    <p>BAY AND NFT</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="user" class="nav-link">
                            <i class="fa-solid fa-user-plus"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <?php }?>

                    <li class="nav-item">
                    <a href="my-profile" class="nav-link">
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

<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Centered column -->
        <div class="col-md-6 mx-auto">
          <!-- general form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">All Notifications</h3>
            </div>
            <form>

  <!-- Main content -->
  <section class="content mt-2">
    <div class="container-fluid">
      <div class="row">
        <!-- Centered column -->
        <div class="col-md-11 mx-auto">
          <!-- Notifications cards -->
          <?php
          $ref_table = 'notifications';
          $fetchdata = $database->getReference($ref_table)->getValue();

          if ($fetchdata > 0) {
            foreach ($fetchdata as $key => $row) {
              ?>
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title"><?= $row['plant_name']; ?></h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <img src="<?= $row['plant_photo']; ?>" class="img-circle img-fluid" width="10%" alt="plant Image">
                    </div>
                    <div class="col-md-8">
                      <p><?= $row['message']; ?></p>
                      <p><?= $row['current_date']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="alert alert-info" role="alert">
              No Record Found
            </div>
            <?php
          }
          ?>
          <!-- /.Notifications cards -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </section>
</div>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </section>
</div>



<?php
include('includes/footer.php');
?>
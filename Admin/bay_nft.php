<?php
include('admin_auth.php');

// Redirect unauthorized users to another page
$uid = $verifiedIdToken->claims()->get('sub');
$claims = $auth->getUser($uid)->customClaims;
if(isset($claims['admin']) == false)  {
    header('Location: ./');
    exit();
}


include('includes/header.php');
include('includes/navbar.php');
?>


    <?php
      if(isset($_SESSION['error'])){
          echo "
              <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: '" . $_SESSION['error'] . "',
                      confirmButtonText: 'Okay'
                  });
              </script>
          ";
          unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
          echo "
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: '" . $_SESSION['success'] . "',
                      confirmButtonText: 'Okay'
                  });
              </script>
          ";
          unset($_SESSION['success']);
      }
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- DataTales Example for BAY Details -->
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="font-weight-bold text-primary"> &nbsp;<a href="#addbay" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-primary"> <i class="fas fa-circle-plus fa-lg"></i>&nbsp; Bay Details</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- BAY Details Table -->
                                    <table class="table table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
                                        <!-- Table Header -->
                                        <thead>
                                            <tr>
                                                <th class="text-center">No#</th>
                                                <th class="text-center">BAY</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <!-- Table Body -->
                                        <tbody>
                                            <?php
                                            $ref_table = 'BAY';
                                            $fetchdata = $database->getReference($ref_table)->getValue();

                                            if ($fetchdata > 0) {
                                                $i = 1;
                                                foreach ($fetchdata as $key => $row) {
                                                    ?>
                                                    <tr class="text-center" data-id="<?= $key ?>">
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $row['bay']; ?></td>
                                                        <td>
                                                        <button class="btn btn-primary edit-bay text-white" name="edit-bay"><i class="fas fa-edit"></i> Edit</button>
                                                        <button class="btn btn-danger delete-bay" name="delete-bay"><i class="fas fa-trash"></i> Delete</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="3">No Record Found</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- DataTales Example for NFT Details -->
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="font-weight-bold text-primary"> &nbsp;<a href="#addnft" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-primary"> <i class="fas fa-circle-plus fa-lg"></i>&nbsp; Nft Details</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- NFT Details Table -->
                                    <table class="table table-bordered table-striped" id="myTable2" width="100%" cellspacing="0">
                                        <!-- Table Header -->
                                        <thead>
                                            <tr>
                                                <th class="text-center">No#</th>
                                                <th class="text-center">NFT</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <!-- Table Body -->
                                        <tbody>
                                            <?php
                                                $ref_table = 'NFT';
                                                $fetchdata = $database->getReference($ref_table)->getValue();

                                                if ($fetchdata > 0) {
                                                $i = 1;
                                                foreach ($fetchdata as $key => $row) {
                                            ?>
                                               <tr class="text-center" data-id="<?= $key ?>">
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nft']; ?></td>
                                                <td>
                                                    <button class="btn btn-primary edit-nft text-white" name="edit-nft"><i class="fas fa-edit"></i> Edit</button>
                                                    <button class="btn btn-danger delete-nft" name="delete-nft"><i class="fas fa-trash"></i> Delete</button>
                                                </td>
                                                </tr>
                                            <?php
                                                }
                                                } else {
                                            ?>
                                                <tr>
                                                <td colspan="3">No Record Found</td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    include('Modal/nft_modal.php');
    include('Modal/bay_modal.php');
    include('includes/footer.php');
    ?>

<script>
  $(document).ready(function() {
    // Initialize the modal
    $('#editnft').modal();

    // Handle Edit button click
    $('.edit-nft').click(function() {
      // Get the NFT ID from the table row
      var nftId = $(this).closest('tr').data('id');

      // Use AJAX to fetch the data from Firebase using the NFT ID
      $.ajax({
        url: 'nft_row.php',
        type: 'POST',
        data: { id: nftId },
        success: function(data) {
          // Parse the data (assuming it's in JSON format)
          var nftData = JSON.parse(data);

          // Populate the modal with the retrieved data
          $('#editnft').find('.nftid').val(nftId);
          $('#editnft').find('#edit_nft').val(nftData.nft);

          // Show the modal
          $('#editnft').modal('show');
        },
        error: function(error) {
          console.log('Error fetching data: ', error);
        }
      });
    });
  });
</script>



<script>
$(document).ready(function() {
  // Initialize the modal
  $('#deletenft').modal();

  // Handle Delete button click
  $('.delete-nft').click(function() {
    // Get the NFT ID from the table row
    var nftId = $(this).closest('tr').data('id');

    // Use AJAX to fetch the data from Firebase using the NFT ID
    $.ajax({
      url: 'nft_row.php',
      type: 'POST',
      data: { id: nftId },
      success: function(data) {
        // Parse the data (assuming it's in JSON format)
        var nftData = JSON.parse(data);

        // Populate the modal with the retrieved data
        $('#deletenft').find('.nftid').val(nftId);

        // Set the NFT name in the modal
        $('#delete_nft_name').text(nftData.nft);

        // Show the modal
        $('#deletenft').modal('show');
      },
      error: function(error) {
        console.log('Error fetching data: ', error);
      }
    });
  });
});

</script>


<script>
  $(document).ready(function() {
    // Initialize the modal
    $('#editbay').modal();
    // Handle Edit button click
    $('.edit-bay').click(function() {
      // Get the NFT ID from the table row
      var bayId = $(this).closest('tr').data('id');

      // Use AJAX to fetch the data from Firebase using the NFT ID
      $.ajax({
        url: 'bay_row.php',
        type: 'POST',
        data: { id: bayId },
        success: function(data) {
          // Parse the data (assuming it's in JSON format)
          var bayData = JSON.parse(data);

          // Populate the modal with the retrieved data
          $('#editbay').find('.bayid').val(bayId);
          $('#editbay').find('#edit_bay').val(bayData.bay);

          // Show the modal
          $('#editbay').modal('show');
        },
        error: function(error) {
          console.log('Error fetching data: ', error);
        }
      });
    });
  });
</script>


<script>
$(document).ready(function() {
  // Initialize the modal
  $('#deletebay').modal();

  // Handle Delete button click
  $('.delete-bay').click(function() {
    // Get the NFT ID from the table row
    var bayId = $(this).closest('tr').data('id');

    // Use AJAX to fetch the data from Firebase using the NFT ID
    $.ajax({
      url: 'bay_row.php',
      type: 'POST',
      data: { id: bayId },
      success: function(data) {
        // Parse the data (assuming it's in JSON format)
        var bayData = JSON.parse(data);

        // Populate the modal with the retrieved data
        $('#deletebay').find('.bayid').val(bayId);

        // Set the NFT name in the modal
        $('#delete_bay_name').text(bayData.bay);

        // Show the modal
        $('#deletebay').modal('show');
      },
      error: function(error) {
        console.log('Error fetching data: ', error);
      }
    });
  });
});

</script>


<script>
    $(document).ready(function() {
        $('#myTable2').DataTable();
    });
</script>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
    <?php
    session_start();
    include('includes/header.php');
    include('includes/navbar.php');
    ?>

    <?php
                            if(isset($_SESSION['error'])){
                            echo "
                                <div class='alert alert-danger alert-dismissible text-center'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-warning'></i> Error! ".$_SESSION['error']."</h4>

                                </div>
                            ";
                            unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['success'])){
                            echo "
                                <div class='alert alert-success alert-dismissible text-center'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-check'></i> Success! ".$_SESSION['success']."</h4>

                                </div>
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
                                <h4 class="font-weight-bold text-success">BAY Details&nbsp;<a href="#addbay" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> New</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- BAY Details Table -->
                                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
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
                                <h4 class="font-weight-bold text-success">NFT Details&nbsp;<a href="#addnft" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> New</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- NFT Details Table -->
                                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
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


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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




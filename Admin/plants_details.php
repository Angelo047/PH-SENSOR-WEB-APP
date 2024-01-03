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
				<div class="col-sm-12">
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header">
                        <h4 class="font-weight-bold text-success">Plants Details&nbsp;<a href="#addplantsdetails" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> New</a></h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th class="text-center">No#</th>
                                        <th class="text-center">Plants Name</th>
                                        <th class="text-center">Required pH Level</th>
                                        <th class="text-center">Days Harvest</th>
                                        <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php
                                            $ref_table = 'plants_details';
                                            $fetchdata = $database->getReference($ref_table)->getValue();

                                            if ($fetchdata > 0) {
                                                $i = 1;
                                                foreach ($fetchdata as $key => $row) {
                                                    ?>
                                                    <tr class="text-center"  data-id="<?= $key ?>">
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $row['plant_name']; ?></td>
                                                        <td>
                                                          <?= $row['ph_lvl_low']; ?>
                                                          <?= $row['ph_lvl_high']; ?>
                                                        </td>
                                                        <td><?= $row['days_harvest']; ?></td>

                                                        <td>
                                                        <button class="btn btn-primary edit-plant text-white" name="edit-plant"><i class="fas fa-edit"></i> Edit</button>
                                                        <button class="btn btn-danger delete-plant" name="delete-plant"><i class="fas fa-trash"></i> Delete</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="9">No Record Found</td>
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
include('Modal/plants_details_modal.php');
include('includes/footer.php');
?>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize the modal
    $('#editplant').modal();

    // Handle Edit button click
    $('.edit-plant').click(function() {
      // Get the NFT ID from the table row
      var plantId = $(this).closest('tr').data('id');

      // Use AJAX to fetch the data from Firebase using the NFT ID
      $.ajax({
        url: 'plant_details_row.php',
        type: 'POST',
        data: { id: plantId },
        success: function(data) {
          // Parse the data (assuming it's in JSON format)
          var plantData = JSON.parse(data);

          // Populate the modal with the retrieved data
          $('#editplant').find('.plantid').val(plantId);
          $('#editplant').find('#plant_name').val(plantData.plant_name);
          $('#editplant').find('#ph_lvl_high').val(plantData.ph_lvl_high);
          $('#editplant').find('#ph_lvl_low').val(plantData.ph_lvl_low);
          $('#editplant').find('#days_harvest').val(plantData.days_harvest);


          // Show the modal
          $('#editplant').modal('show');
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
  $('#deleteplant').modal();

  // Handle Delete button click
  $('.delete-plant').click(function() {
    // Get the NFT ID from the table row
    var plantId = $(this).closest('tr').data('id');

    // Use AJAX to fetch the data from Firebase using the NFT ID
    $.ajax({
      url: 'plant_details_row.php',
      type: 'POST',
      data: { id: plantId},
      success: function(data) {
        // Parse the data (assuming it's in JSON format)
        var plantData = JSON.parse(data);

        // Populate the modal with the retrieved data
        $('#deleteplant').find('.plantid').val(plantId);

        // Set the NFT name in the modal
        $('#delete_plant_name').text(plantData.plant_name);

        // Show the modal
        $('#deleteplant').modal('show');
      },
      error: function(error) {
        console.log('Error fetching data: ', error);
      }
    });
  });
});

</script>
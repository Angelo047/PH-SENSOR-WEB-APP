<?php
include('admin_auth.php');

// Redirect unauthorized users to another page
$uid = $verifiedIdToken->claims()->get('sub');
$claims = $auth->getUser($uid)->customClaims;
if(isset($claims['admin']) == false)  {
    header('Location: index.php');
    exit();
}

include('includes/header.php');
include('includes/navbar.php');
?>


<div class="content-wrapper">

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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="font-weight-bold text-primary"> &nbsp;<a href="#addplantsdetails" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-primary"><i class="fas fa-circle-plus fa-lg"></i>&nbsp; Add Plant Details</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
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

                                        if (!empty($fetchdata)) {
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
                                                        <a class="btn btn-primary edit-plant"><i class="fas fa-edit"> </i> Edit</a>
                                                        <a class="btn btn-danger delete-plant"><i class="fas fa-trash"> </i> Delete</a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                        ?>
                                            <tr>
                                                <td colspan="5">No Record Found</td>
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
</div>
</div>

<?php
include('Modal/plants_details_modal.php');
include('includes/footer.php');
?>


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


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>


<script>
  function displayImagePreview() {
    var input = document.getElementById('plant_photo');
    var img = document.getElementById('profile-pic');
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        img.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      img.src = 'pics/default.png';
    }
  }

  function updatePlantImage() {
    // Add any additional logic here if needed
  }
</script>
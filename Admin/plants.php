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
                        <h4 class="font-weight-bold text-success">Plants&nbsp;<a href="#addplants" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> New</a></h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th class="text-center">No#</th>
                                        <th class="text-center">Plants Name</th>
                                        <th class="text-center">Date Planted</th>
                                        <th class="text-center">Estimated Date Harvested</th>
                                        <th class="text-center">Required pH Level</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Bay</th>
                                        <th class="text-center">NFT</th>
                                        <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php
                                            $ref_table = 'plants';
                                            $fetchdata = $database->getReference($ref_table)->getValue();

                                            if ($fetchdata > 0) {
                                                $i = 1;
                                                foreach ($fetchdata as $key => $row) {
                                                    ?>
                                                    <tr class="text-center">
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $row['plant_name']; ?></td>
                                                        <td><?= $row['date_planted']; ?></td>
                                                        <td><?= $row['date_harvest']; ?></td>
                                                        <td>
                                                          <?= $row['ph_lvl_low']; ?>
                                                          <?= $row['ph_lvl_high']; ?>
                                                        </td>
                                                        <td><span class="badge bg-success"><?= $row['plant_status']; ?></span></td>
                                                        <td><?= $row['bay']; ?></td>
                                                        <td><?= $row['nft']; ?></td>
                                                        <td>
                                                            <a href="plant-info.php?id=<?= $key; ?>" class="btn btn-success"><i class="fas fa-eye"></i> View</a>
                                                            <a href="report.php?id=<?= $key; ?>" class="btn btn-primary"><i class="fa-solid fa-file-pen"></i> Report</a>
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
include('Modal/plant_modal.php');
include('includes/footer.php');
?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>


<script>
  function displayImagePreview() {
    var input = document.getElementById('input-file');
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


<script>
  document.addEventListener('DOMContentLoaded', function () {
    // pH level data for each plant
    const pHLevels = {
      'Lettuce': { low: 5.5, high: 6.5 },
      'Spinach': { low: 5.5, high: 6.6 },
      'Swiss Chard': { low: 6.0, high: 6.5 },
      'Basil': { low: 5.5, high: 6.5 },
      'Mint': { low: 5.5, high: 6.0 },
      'Peppers': { low: 6.0, high: 6.7 },
    };

    // Function to update pH level based on selected plant name
    function updatePHLevel() {
      var selectPlant = document.getElementById('plant_name');
      var pHLevelLowInput = document.getElementById('ph_lvl_low');
      var pHLevelHighInput = document.getElementById('ph_lvl_high');

      var selectedPlant = selectPlant.value;

      // Check if the selected plant has a corresponding pH level
      if (pHLevels.hasOwnProperty(selectedPlant)) {
        // Set the low and high pH levels in the input fields
        pHLevelLowInput.value = pHLevels[selectedPlant].low;
        pHLevelHighInput.value = pHLevels[selectedPlant].high;
      } else {
        // If the selected plant doesn't have a corresponding pH level, set a default value or leave it empty
        pHLevelLowInput.value = ''; // You can set a default value here if needed
        pHLevelHighInput.value = ''; // You can set a default value here if needed
      }
    }

    // Attach the updatePHLevel function to the change event of the plant_name element
    document.getElementById('plant_name').addEventListener('change', updatePHLevel);
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Estimated harvest days for each plant
    const harvestDays = {
      'Basil': 28,
      'Lettuce': 28,
      'Spinach': 28,
      'Swiss Chard': 35,
      'Mint': 42,
      'Peppers': 91
    };

    // Function to update estimated harvest date based on selected plant and date planted
    function updateEstimatedHarvestDate() {
      var selectPlant = document.getElementById('plant_name');
      var datePlantedInput = document.getElementById('date_planted');
      var estimatedHarvestDateInput = document.getElementById('date_harvest');

      var selectedPlant = selectPlant.value;
      var datePlanted = new Date(datePlantedInput.value);

      // Check if the selected plant has a corresponding estimated harvest days
      if (harvestDays.hasOwnProperty(selectedPlant) && !isNaN(datePlanted.getTime())) {
        var estimatedHarvestDate = new Date(datePlanted);
        estimatedHarvestDate.setDate(datePlanted.getDate() + harvestDays[selectedPlant]);

        // Format the date in 'YYYY-MM-DD' for the input
        var formattedEstimatedHarvestDate = estimatedHarvestDate.toISOString().split('T')[0];
        estimatedHarvestDateInput.value = formattedEstimatedHarvestDate;
      } else {
        // If the selected plant doesn't have a corresponding estimated harvest days or date planted is not valid, leave it empty
        estimatedHarvestDateInput.value = '';
      }
    }

    // Attach the updateEstimatedHarvestDate function to the change event of the plant_name and date_planted elements
    document.getElementById('plant_name').addEventListener('change', updateEstimatedHarvestDate);
    document.getElementById('date_planted').addEventListener('change', updateEstimatedHarvestDate);
  });
</script>

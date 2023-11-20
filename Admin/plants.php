<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<?php
            if(isset($_SESSION['status']))
            {
                echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                unset($_SESSION['status']);
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
                                        <th class="text-center">Date Harvested</th>
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
                                                        <td><?= $row['ph_lvl']; ?></td>
                                                        <td><span class="badge bg-success"><?= $row['plant_status']; ?></span></td>
                                                        <td><?= $row['bay']; ?></td>
                                                        <td><?= $row['nft']; ?></td>
                                                        <td>
                                                            <a href="plant-info.php?id=<?= $key; ?>" class="btn btn-success">View</a>
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
      'Lettuce': '5.5-6.5',
      'Cucumber': '5.8-6.0',
      'Peppers': '6.0-6.5',
      'Mint': '5.5-6.0',
      'Spinach': '5.5-6.6',
      'Swiss Chard': '6.0-6.5',
      'Basil': '5.5-6.5',
    };

    // Function to update pH level based on selected plant name
    function updatePHLevel() {
      var selectPlant = document.getElementById('plant_name');
      var pHLevelInput = document.getElementById('ph_lvl');

      var selectedPlant = selectPlant.value;

      // Check if the selected plant has a corresponding pH level
      if (pHLevels.hasOwnProperty(selectedPlant)) {
        pHLevelInput.value = pHLevels[selectedPlant];
      } else {
        // If the selected plant doesn't have a corresponding pH level, set a default value or leave it empty
        pHLevelInput.value = ''; // You can set a default value here if needed
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

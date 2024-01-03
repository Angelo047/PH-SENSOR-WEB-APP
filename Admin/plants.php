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

<?php
// Fetch data for BAY
$bayRef = $database->getReference('BAY');
$bayData = $bayRef->getValue();

// Fetch data for NFT
$nftRef = $database->getReference('NFT');
$nftData = $nftRef->getValue();
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


<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>



<script>
    // Initialize Firebase with your own configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBCe1DGEf01SvWTwuBGCuhFKiHVuwMmf5I",
        authDomain: "php-firebase-9b785.firebaseapp.com",
        databaseURL: "https://php-firebase-9b785-default-rtdb.firebaseio.com",
        projectId: "php-firebase-9b785",
        storageBucket: "php-firebase-9b785.appspot.com",
        messagingSenderId: "954656030016",
        appId: "1:954656030016:web:69edbdbcab24f8508ccea5",
        measurementId: "G-TVV3ZFYSCR"
    };

    firebase.initializeApp(firebaseConfig);

     // Function to fetch plant details based on the selected plant name
     function fetchPlantDetails(plantName) {
        var database = firebase.database();
        var ref = database.ref("plants_details");

        // Query to get details based on plant name
        ref.orderByChild("plant_name").equalTo(plantName).once("value", function (snapshot) {
            if (snapshot.exists()) {
                var plantDetails = snapshot.val();
                var phLevelLow = plantDetails[Object.keys(plantDetails)[0]].ph_lvl_low;
                var phLevelHigh = plantDetails[Object.keys(plantDetails)[0]].ph_lvl_high;
                var daysToHarvest = plantDetails[Object.keys(plantDetails)[0]].days_harvest;

                // Update the pH level input fields
                document.getElementById("ph_lvl_low").value = phLevelLow;
                document.getElementById("ph_lvl_high").value = phLevelHigh;

                // Calculate estimated harvest date
                updateEstimatedHarvestDate(daysToHarvest);
            }
        });
    }

    // Function to calculate estimated harvest date
    function updateEstimatedHarvestDate(daysToHarvest) {
        var datePlanted = document.getElementById("date_planted").value;

        if (datePlanted && daysToHarvest) {
            var datePlantedObj = new Date(datePlanted);
            var estimatedHarvestDate = new Date(datePlantedObj.setDate(datePlantedObj.getDate() + parseInt(daysToHarvest)));
            var formattedDate = estimatedHarvestDate.toISOString().split('T')[0];

            // Update the date_harvest input field
            document.getElementById("date_harvest").value = formattedDate;
        }
    }

    // Function to populate the plant names dropdown
    function populatePlantNames() {
        var database = firebase.database();
        var ref = database.ref("plants_details");

        ref.orderByChild("plant_name").once("value", function (snapshot) {
            if (snapshot.exists()) {
                var plantNamesDropdown = document.getElementById("plant_name");

                // Clear existing options
                plantNamesDropdown.innerHTML = "";

                // Populate dropdown with plant names
                snapshot.forEach(function (childSnapshot) {
                    var plantName = childSnapshot.val().plant_name;
                    var option = document.createElement("option");
                    option.value = plantName;
                    option.text = plantName;
                    plantNamesDropdown.appendChild(option);
                });
            }
        });
    }

    // Call the function to populate plant names on page load
    populatePlantNames();

    // Event listener for the plant name dropdown change
    document.getElementById("plant_name").addEventListener("change", function () {
        var selectedPlantName = this.value;
        fetchPlantDetails(selectedPlantName);
    });

    // Event listener for the date_planted input change
    document.getElementById("date_planted").addEventListener("change", function () {
        var selectedPlantName = document.getElementById("plant_name").value;
        fetchPlantDetails(selectedPlantName);
    });
</script>
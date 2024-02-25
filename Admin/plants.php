<?php
include('admin_auth.php');
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



<?php
// Fetch data for BAY
$bayRef = $database->getReference('BAY');
$bayData = $bayRef->getValue();

// Fetch data for NFT
$nftRef = $database->getReference('NFT');
$nftData = $nftRef->getValue();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header">
                        <h4 class="font-weight-bold text-primary"> &nbsp;<a href="#addplants" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-primary"> <i class="fas fa-circle-plus fa-lg"></i>&nbsp; Add Plants</a></h4>
                    </div>
                                <!-- Dropdown Filter -->
                <div class="form-group float-right"> <!-- Add 'float-right' class to align to the right -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"> <!-- Adjust column width for medium-sized screens -->
                                <label for="statusFilter">Filter by Status:</label>
                                <select class="form-control" id="statusFilter">
                                    <option value="Planted" selected>Planted</option>
                                    <option value="Harvested">Harvested</option>
                                    <option value="Withered">Withered</option>
                                </select>
                            </div>
                        </div>
                            <div class="table-responsive mt-2">
                                <table class="table table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th class="text-center">No#</th>
                                        <th class="text-center">Plants Name</th>
                                        <th class="text-center">Date Planted</th>
                                        <th class="text-center estimatedDateHeader" id="estimatedDateHeader">Estimated Date Harvested</th>
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

                                            if (!empty($fetchdata)) {
                                                $i = 1;
                                                foreach ($fetchdata as $key => $row) {
                                                    ?>
                                                    <tr class="text-center" data-id="<?= $key ?>">
                                                        <td><?= $i++; ?></td>
                                                        <td><?= $row['plant_name']; ?></td>
                                                        <td><?= date('M d, Y', strtotime($row['date_planted'])); ?></td>
                                                        <td>
                                                        <?php
                                                            // Check if the plant status is "Withered" or "Harvested"
                                                            if ($row['plant_status'] == 'Withered' || $row['plant_status'] == 'Harvested') {
                                                                // Format the claim_date
                                                                echo date('M d, Y', strtotime($row['claim_date'])); // Display claim_date if status is "Withered" or "Harvested"
                                                            } else {
                                                                // Format the date_harvest
                                                                echo date('M d, Y', strtotime($row['date_harvest'])); // Otherwise, display date_harvest
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $row['ph_lvl_low']; ?> - <?= $row['ph_lvl_high']; ?></td>
                                                        <?php
                                                        $status = $row['plant_status'];
                                                        $badgeClass = '';

                                                        // Set badge color based on plant status
                                                        switch ($status) {
                                                            case 'Withered':
                                                                $badgeClass = 'bg-danger'; // Red background
                                                                break;
                                                            case 'Harvested':
                                                                $badgeClass = 'bg-primary'; // Yellow background
                                                                break;
                                                            default:
                                                                $badgeClass = 'bg-success'; // Green background
                                                                break;
                                                        }
                                                        ?>
                                                        <td><span class="badge <?= $badgeClass ?>"><?= $status ?></span></td>
                                                        <td><?= $row['bay']; ?></td>
                                                        <td><?= $row['nft']; ?></td>
                                                        <td>
                                                        <a href="plant-info?id=<?= $key; ?>" class="btn btn-primary "><i class="fas fa-eye fa-lg"></i></a>
                                                            <a href="report?id=<?= $key; ?>" class="btn btn-primary "><i class="fas fa-file-pen fa-lg"></i></a>
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


                                </div>


<?php
include('Modal/plant_modal.php');
include('includes/footer.php');
?>



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


<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>


<script>
    // Initialize Firebase with your own configuration
    var firebaseConfig = {
        apiKey: "AIzaSyAIjMwy9jr4Cr_cudDpn5A3RpxUpgL6jDw",
        authDomain: "ph-sensor-web-app.firebaseapp.com",
        databaseURL: "https://ph-sensor-web-app-default-rtdb.firebaseio.com",
        projectId: "ph-sensor-web-app",
        storageBucket: "ph-sensor-web-app.appspot.com",
        messagingSenderId: "385380264610",
        appId: "1:385380264610:web:fbac7afd889b8e8feb85fb",
        measurementId: "G-5JN9Y96ZM9"
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

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>


<script>
    $(document).ready(function() {
        // Initial setup to hide "Estimated Date Harvested" column
        // Default value for the filter
        var defaultStatus = 'Planted';
        $('#statusFilter').val(defaultStatus);

        // Function to filter rows based on status
        function filterRowsByStatus(status) {
            $('#myTable tbody tr').hide(); // Hide all rows initially
            $('#myTable tbody tr').each(function() {
                var rowStatus = $(this).find('td:nth-child(6)').text().trim();
                if (rowStatus === status) {
                    $(this).show();
                }
            });
        }

        // Trigger filtering based on default status
        filterRowsByStatus(defaultStatus);

        // Event handler for filter change
        $('#statusFilter').on('change', function() {
            var status = $(this).val();
            if (status === 'all') {
                $('#myTable tbody tr').show(); // Show all rows if 'all' is selected
                $('#estimatedDateHeader').show(); // Show "Estimated Date Harvested" column
                $('#estimatedDateHeader').text('Estimated Date Harvested'); // Reset header text
            } else {
                filterRowsByStatus(status);
                // Update header text based on status
                if (status === 'Withered') {
                    $('#estimatedDateHeader').text('Withered Date');
                } else if (status === 'Harvested') {
                    $('#estimatedDateHeader').text('Harvested Date');
                } else {
                    $('#estimatedDateHeader').text('Estimated Date Harvested');
                }
            }
        });
    });
</script>
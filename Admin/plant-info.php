<?php
include('admin_auth.php'); // Include the file that contains authorization logic
include('includes/header.php');
include('includes/navbar.php');
?>


<style>

    .ph-value {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .ph-value-text {
        font-size: 3rem;
        font-weight: bold;
        text-align: center;
    }

    .ph-value-number {
        font-size: 10rem;
        font-weight: bold;
        text-align: center;
    }

    .switch {
        position: relative;
        display: block;
        vertical-align: top;
        width: 120px;
        height: 50px;
        padding: 3px;
        margin: 0 10px 10px 0;
        background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
        background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
        border-radius: 18px;
        box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        box-sizing:content-box;
    }
    .switch-input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        box-sizing:content-box;
    }
    .switch-label {
        position: relative;
        display: block;
        height: inherit;
        font-size: 10px;
        text-transform: uppercase;
        background: #eceeef;
        border-radius: inherit;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
        box-sizing:content-box;
    }
    .switch-label:before, .switch-label:after {
        position: absolute;
        top: 50%;
        margin-top: -.5em;
        line-height: 1;
        -webkit-transition: inherit;
        -moz-transition: inherit;
        -o-transition: inherit;
        transition: inherit;
        box-sizing:content-box;
    }
    .switch-label:before {
        content: attr(data-off);
        right: 11px;
        color: #aaaaaa;
        text-shadow: 0 1px rgba(255, 255, 255, 0.5);
    }
    .switch-label:after {
        content: attr(data-on);
        left: 11px;
        color: #FFFFFF;
        text-shadow: 0 1px rgba(0, 0, 0, 0.2);
        opacity: 0;
    }
    .switch-input:checked ~ .switch-label {
        background: #2ecc71;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
    }
    .switch-input:checked ~ .switch-label:before {
        opacity: 0;
    }
    .switch-input:checked ~ .switch-label:after {
        opacity: 1;
    }
    .switch-handle {
        position: absolute;
        top: 4px;
        left: 4px;
        width: 38px;
        height: 48px;
        background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
        background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
        border-radius: 100%;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    }
    .switch-handle:before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -6px 0 0 -6px;
        width: 12px;
        height: 12px;
        background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
        background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
        border-radius: 6px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
    }
    .switch-input:checked ~ .switch-handle {
        left: 94px;
        box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
    }

    /* Transition
    ========================== */
    .switch-label, .switch-handle {
        transition: All 0.3s ease;
        -webkit-transition: All 0.3s ease;
        -moz-transition: All 0.3s ease;
        -o-transition: All 0.3s ease;
    }

    .card {
        height: 410px; /* Adjust the height as needed */
    }

</style>


<?php
    if(isset($_SESSION['error'])){
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '" . $_SESSION['error'] . "',
                    showConfirmButton: false,
                    timer: 3000 // Close the alert after 3 seconds
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
                    showConfirmButton: false,
                    timer: 3000 // Close the alert after 3 seconds
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
            <div class="row mb-3">
                <div class="col-md-3">
                    <ol class="breadcrumb float-sm-left">
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['id'])) {
        $key_child = $_GET['id'];

        $ref_table = 'plants';
        $getData = $database->getReference($ref_table)->getChild($key_child)->getValue();

        if ($getData > 0) {
            ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-3">
                        <!-- Main content -->
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <?= $getData['plant_name']; ?>
                                    </div>
                                    <div class="card-body text-center">
                                        <?php
                                        // Check if the 'plant_photo' key exists in the data
                                        if (isset($getData['plant_photo'])) {
                                            $plantPhotoURL = $getData['plant_photo'];
                                            ?>
                                            <img src="<?= $plantPhotoURL ?>" alt="Plant Photo" style="max-width: 300px; height:300px;">
                                            <?php
                                        } else {
                                            ?>
                                            <p>No plant photo available</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- INFO -->
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        PLANT INFORMATION
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-3" method="post" action="code.php">
                                            <!-- Plant Name -->
                                            <div class="col-md-6">
                                                <label for="plantName">Plant Name:</label>
                                                <input type="text" class="form-control" id="plantName" placeholder="Lettuce" disabled selected value="<?= $getData['plant_name']; ?>">
                                            </div>
                                            <!-- Required pH Level -->
                                            <div class="col-md-6">
                                                <label for="requiredPh">Required pH Level:</label>
                                                <input type="text" class="form-control" id="requiredPh" placeholder="5.5 to an upper limit of pH 7.0" disabled selected value="<?= $getData['ph_lvl_low']; ?>-<?= $getData['ph_lvl_high']; ?>">
                                            </div>

                                            <!-- Date Planted -->
                                            <div class="col-md-6">
                                                <label>Date Planted</label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control datetimepicker-input" id="datePlanted" disabled selected value="<?= $getData['date_planted']; ?>" />
                                                    <div class="input-group-append" data-target="#reservationdate">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Estimated Date Harvested -->
                                            <div class="col-md-6">
                                                <label>
                                                    <?php
                                                    if ($getData['plant_status'] == 'Withered') {
                                                        echo 'Withered Date';
                                                    } elseif ($getData['plant_status'] == 'Harvested') {
                                                        echo 'Harvested Date';
                                                    } else {
                                                        echo 'Estimated Date Harvested';
                                                    }
                                                    ?>
                                                </label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control datetimepicker-input" id="dateHarvested" disabled selected value="<?= ($getData['plant_status'] == 'Withered' || $getData['plant_status'] == 'Harvested') ? date('M d, Y', strtotime($getData['claim_date'])) : date('M d, Y', strtotime($getData['date_harvest'])) ?>" />
                                                    <div class="input-group-append" data-target="#reservationdate">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label>BAY</label>
                                                <div class="input-group date" id="reservationdate">
                                                    <input type="text" class="form-control" id="dateHarvested" placeholder="November 17, 2023" disabled selected value="<?= $getData['bay']; ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label>NFT</label>
                                                <div class="input-group date" id="reservationdate">
                                                    <input type="text" class="form-control" disabled selected value="<?= $getData['nft']; ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Plant Status</label>
                                                <select class="form-control" name="plant_status" id="plantStatusSelect">
                                                    <option value="" disabled selected>Select Plant Status</option>
                                                    <option value="Planted" <?= ($getData['plant_status'] == 'Planted') ? 'selected' : '' ?>>Planted</option>
                                                    <option value="Harvested" <?= ($getData['plant_status'] == 'Harvested') ? 'selected' : '' ?>>Harvested</option>
                                                    <option value="Withered" <?= ($getData['plant_status'] == 'Withered') ? 'selected' : '' ?>>Withered</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $key_child ?>">
                                            <div class="col-md-6 mt-6">
                                                <button type="submit" class="btn btn-primary" id="updateStatusButton" disabled>Update Status</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-6 mt-6">
                                <div class="card">
                                    <div class="card-header">
                                        PUMP CONTROL
                                    </div>
                                    <div class="card-body" style="min-height: 330px;">
                                        <!-- Switch for Relay 1 -->
                                        <div class="mb-4 text-center">
                                            <label for="relay1Checkbox">Higher pH Level</label>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <label class="switch">
                                                    <input class="switch-input" type="checkbox" id="relay1Checkbox" checked onchange="toggleRelay(1)" />
                                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Switch for Relay 2 -->
                                        <div class="text-center">
                                            <label for="relay2Checkbox">Lower pH Level</label>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <label class="switch">
                                                    <input class="switch-input" type="checkbox" id="relay2Checkbox" checked onchange="toggleRelay(2)" />
                                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Estimated Date of Harvest
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <input id="knob" type="text" class="knob" value="39" data-skin="tron" data-thickness="0.2" data-width="250" data-height="250" data-fgColor="#2C3090">
                                    <div class="knob-label"><b>Days before Harvest</b></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
            </div>

        <br>

        <?php

    } else {
        $_SESSION['status'] = "Invalid ID!";
        header('Location: index.php');
        exit();
    }

} else {
    $_SESSION['status'] = "No Record Found!";
    header('Location: index.php');
    exit();
}

?>

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';


    $database = $factory->createDatabase();

    $plantId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($plantId) {
        $plantInfoRef = $database->getReference('/plants')->getChild($plantId);
        $plantInfo = $plantInfoRef->getValue();

        if ($plantInfo) {
            $requiredLowPhLevel = $plantInfo['ph_lvl_low'];
            $requiredHighPhLevel = $plantInfo['ph_lvl_high'];

            // Perform the pH level check and notification creation
            function checkPhLevel($requiredLowPhLevel, $requiredHighPhLevel, $database, $plantInfo) {
                $phSensorDataRef = $database->getReference('/phSensorData');
                $latestPhSensorData = $phSensorDataRef->orderByKey()->limitToLast(1)->getSnapshot()->getValue();
                $latestPhValue = reset($latestPhSensorData);
            }

            // Call the pH level check function
        } else {
            echo 'Plant information not found.' . PHP_EOL;
        }
    } else {
        echo 'Invalid plant ID.' . PHP_EOL;
    }
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <!-- Interactive2 data -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-scale-unbalanced-flip"></i>
                            Realtime PH Level
                        </h3>
                        <div class="card-tools">
                            <div id="realtime2">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="ph-value"></div>
                    </div>
                    <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-lg-9 col-md-6">
                <!-- Interactive chart -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Realtime PH Level Graph
                        </h3>
                        <div class="card-tools">
                            <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="interactive" style="height: 300px;"></div>
                    </div>
                    <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>


</div>
</div>
</div>
</div>




<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>


<script>
      // Initialize Firebase
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

// Get a reference to the Firebase database
var database = firebase.database();

// Function to update UI based on relay status
function updateUI(relayNumber, relayStatus, disabled) {
    const checkboxId = `relay${relayNumber}Checkbox`;
    const checkbox = document.getElementById(checkboxId);

    // Update checkbox state based on relay status
    checkbox.checked = relayStatus === 'on';

    // Disable the checkbox if disabled is true
    checkbox.disabled = disabled;

    // Disable the other checkbox if the current one is checked or disabled
    const otherCheckbox = relayNumber === 1 ? document.getElementById('relay2Checkbox') : document.getElementById('relay1Checkbox');
    otherCheckbox.disabled = checkbox.checked || disabled;

    // Update the switch label for correct display
    const switchLabel = checkbox.nextElementSibling;
    switchLabel.dataset.on = relayStatus === 'on' ? 'On' : 'Off';
    switchLabel.dataset.off = relayStatus === 'on' ? 'Off' : 'On';
}


    // Function to get the status of the other relay
    function getOtherRelayStatus(currentRelayNumber) {
        const otherRelayNumber = currentRelayNumber === 1 ? 2 : 1;
        const otherRelayStatusRef = database.ref(`/relay/${otherRelayNumber}/switch`);

        return otherRelayStatusRef.once('value').then(snapshot => {
            return snapshot.val();
        });
    }

    // Function to toggle Relay
    function toggleRelay(relayNumber) {
        const relayRef = database.ref(`/relay/${relayNumber}`);
        relayRef.once('value').then(snapshot => {
            const currentStatus = snapshot.child('switch').val();
            const disabled = snapshot.child('disabled').val();

            // If the current relay is disabled, exit
            if (disabled) return;

            const newStatus = currentStatus === 'on' ? 'off' : 'on';

            relayRef.child('switch').set(newStatus)
                .then(() => {
                    updateUI(relayNumber, newStatus, disabled);
                    console.log(`Switch ${relayNumber} toggled successfully.`);
                })
                .catch(error => {
                    console.error(`Error toggling switch ${relayNumber}: ${error.message}`);
                });
        });
    }

    // Monitor changes in the relay status and update the UI
    function monitorRelayStatus(relayNumber) {
        const relayRef = database.ref(`/relay/${relayNumber}`);
        const disabledRef = database.ref(`/relay/${relayNumber}/disabled`);

        relayRef.on('value', snapshot => {
            const relayStatus = snapshot.val();

            // Get the disabled status of the relay
            disabledRef.once('value').then(disabledSnapshot => {
                const disabled = disabledSnapshot.val();
                updateUI(relayNumber, relayStatus, disabled);
            });
        });
    }

    // Call monitorRelayStatus for each relay you want to monitor
    monitorRelayStatus(1);
    monitorRelayStatus(2);

    // Disable the other checkbox if one is checked
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const otherCheckbox = this.id === 'relay1Checkbox' ? document.getElementById('relay2Checkbox') : document.getElementById('relay1Checkbox');
            otherCheckbox.disabled = this.checked;
        });
    });

    // Disable the other switch if one is turned on
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const relayNumber = this.id === 'relay1Checkbox' ? 1 : 2;
            const otherRelayNumber = relayNumber === 1 ? 2 : 1;
            const otherSwitch = document.getElementById(`relay${otherRelayNumber}Checkbox`);
            if (this.checked) {
                otherSwitch.disabled = true;
            } else {
                const otherSwitchStatus = getOtherRelayStatus(otherRelayNumber);
                if (otherSwitchStatus === 'off') {
                    otherSwitch.disabled = false;
                }
            }
        });
    });

// Function to check pH level and control switches
function checkAndUpdateSwitches() {
    // Get current pH level data from Firebase
    database.ref('/phSensorData').once('value').then(snapshot => {
        const phSensorData = snapshot.val();
        const latestPhValue = phSensorData ? phSensorData[Object.keys(phSensorData).pop()] : null;

        if (!latestPhValue) return; // If no pH data available, exit

        // Get plant pH level range from Firebase or any other source
        const plantId = <?php echo json_encode($plantId); ?>;
        database.ref(`/plants/${plantId}`).once('value').then(plantSnapshot => {
            const plantInfo = plantSnapshot.val();
            if (!plantInfo || !('ph_lvl_low' in plantInfo) || !('ph_lvl_high' in plantInfo)) return; // If plant info incomplete, exit

            const requiredLowPhLevel = plantInfo['ph_lvl_low'];
            const requiredHighPhLevel = plantInfo['ph_lvl_high'];

            // Determine if pH level is within the acceptable range
            if (latestPhValue >= requiredLowPhLevel && latestPhValue <= requiredHighPhLevel) {
                // pH level is within the acceptable range, turn off relay 1 and relay 2
                database.ref('/relay/1/disabled').set(true);
                database.ref('/relay/2/disabled').set(true);
                // Also turn off the switch under relay
                database.ref('/relay/1/switch').set('off');
                database.ref('/relay/2/switch').set('off');
            } else {
                // pH level is outside the acceptable range, enable the switches
                database.ref('/relay/1/disabled').set(false);
                database.ref('/relay/2/disabled').set(false);
                database.ref('/relay/1/switch').set('off');
                database.ref('/relay/2/switch').set('off');
            }
        });
    });
}

// Call the function to check pH level and control switches
checkAndUpdateSwitches();
</script>


    <script>
        // Function to check if switches should be disabled
        function checkSwitch() {
            // Make an AJAX request to your PHP script with a plant ID
            var plantId = <?php echo json_encode($plantId); ?>;
            $.ajax({
                url: 'switch_row.php',
                method: 'GET',
                data: { id: plantId },
                success: function(response) {
                    console.log(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        // Set an interval to periodically check for switch status
        setInterval(checkSwitch, 10000); // 1000 milliseconds = 1 second, adjust as needed
</script>


<?php
include('includes/footer.php');
?>

<script>
// Use JavaScript to periodically check the server for notifications
function checkNotifications() {
    // Make an AJAX request to your PHP script with a plant ID
    var plantId = <?php echo json_encode($plantId); ?>;

    $.ajax({
        url: 'fetch_data.php',
        method: 'GET',
        data: { id: plantId },
        success: function(response) {
            // Display the result in the console (you can modify this part)
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

// Set an interval to periodically check for notifications
setInterval(checkNotifications, 100000); // 3000 milliseconds = 3 seconds, adjust as needed
</script>



<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- AdminLTE for demo purposes -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>


<!-- RealTime Ph lvl Chart -->

<script>
$(function () {
    var maxDataPoints = 15; // Update max data points to 15
    var chart;

    function updateChart() {
        $.ajax({
            url: 'ph-sensor-result.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    var phValues = Object.values(data);
                    var startIndex = Math.max(0, phValues.length - maxDataPoints);
                    var slicedPhValues = phValues.slice(startIndex);

                    var xValues = Array.from({ length: slicedPhValues.length }, (_, i) => i + 1); // Start x-axis from 1

                    var trace = {
                        x: xValues,
                        y: slicedPhValues,
                        type: 'scatter',
                        mode: 'lines+markers+text', // Add text to the lines and markers
                        line: { width: 2, shape: 'spline' },
                        text: slicedPhValues.map(value => value.toFixed(1)), // Format pH result to one decimal place
                        textposition: 'top center', // Position of the text
                        fill: 'tozeroy',
                        fillcolor: 'rgba(60, 141, 188, 0.2)',
                        marker: { color: '#3c8dbc' }
                    };

                    // Clear existing chart
                    if (chart) {
                        Plotly.purge('interactive');
                    }

                    chart = Plotly.newPlot('interactive', [trace], {
                        margin: { t: 0, b: 40, l: 30, r: 10 },
                        xaxis: { range: [1, slicedPhValues.length] }, // Start x-axis from 1
                        yaxis: { range: [Math.min(...slicedPhValues) - 0.1, 15] } // Set max value of y-axis to 15
                    });
                }
            },
            complete: function () {
                setTimeout(updateChart, 1500);
            }
        });
    }

    updateChart();

    $('#realtime .btn').click(function () {
        if ($(this).data('toggle') === 'on') {
            updateChart();
        } else {
            clearTimeout(updateChart);
        }
    });
});
</script>


<!-- jQuery Knob -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>

<script>
$(function () {
    /* jQueryKnob */
    $('#knob').knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {
                var a = this.angle(this.cv) // Angle
                ,
                    sa = this.startAngle // Previous start angle
                ,
                    sat = this.startAngle // Start angle
                ,
                    ea // Previous end angle
                ,
                    eat = sat + a // End angle
                ,
                    r = true

                this.g.lineWidth = this.lineWidth

                this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3)

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value)
                    this.o.cursor && (sa = ea - 0.3) && (ea = ea + 0.3)
                    this.g.beginPath()
                    this.g.strokeStyle = this.previousColor
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                    this.g.stroke()
                }

                this.g.beginPath()
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                this.g.stroke()

                this.g.lineWidth = 2
                this.g.beginPath()
                this.g.strokeStyle = this.o.fgColor
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                this.g.stroke()

                return false
            }
        }
    });

    function updateDaysBeforeHarvest() {
        // Get the date_harvest value from the HTML element or use the one retrieved from your PHP code
        var dateHarvest = new Date($('#dateHarvested').val());

        // Calculate the difference in days between the current date and date_harvest
        var currentDate = new Date();
        var daysBeforeHarvest = Math.ceil((dateHarvest - currentDate) / (1000 * 60 * 60 * 24));

        // Update the Knob chart with the calculated value
        $('#knob').val(daysBeforeHarvest).trigger('change');
        $('.knob-label').html('<b>Days before Harvest</b>');
    }

    updateDaysBeforeHarvest(); // Initial update

    // Set up a timer to update the Knob chart every 24 hours (adjust as needed)
    setInterval(updateDaysBeforeHarvest, 24 * 60 * 60 * 1000); // 24 hours in milliseconds
});
</script>


<script>
    // Get the select element
    var plantStatusSelect = document.getElementById('plantStatusSelect');
    // Get the update status button
    var updateStatusButton = document.getElementById('updateStatusButton');

    // Add change event listener to select element
    plantStatusSelect.addEventListener('change', function() {
        // Enable/disable the update status button based on the selected value
        updateStatusButton.disabled = this.value === '';
    });
</script>


<!-- Realtime Ph Lvl DATA-->
<script>
    $(function () {
        function updateData() {
            $.ajax({
                url: 'ph-sensor-result.php', // Update with the correct endpoint
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        var phValues = Object.values(data);
                        var latestPhValue = phValues[phValues.length - 1];

                        // Format pH value to one whole number and one decimal
                        latestPhValue = parseFloat(latestPhValue).toFixed(1);

                        // Update the text element with the latest pH value and pH level text
                        $('.ph-value').html('<div class="ph-value-text">pH level</div><div class="ph-value-number">' + latestPhValue + '</div>');
                    }
                },
                complete: function () {
                    setTimeout(updateData, 1500);
                }
            });
        }

        // Start updating data
        updateData();

        // Toggle chart updating
        $('#realtime2 .btn').click(function () {
            if ($(this).data('toggle') === 'on') {
                updateData();
            } else {
                // Clear the update interval
                clearTimeout(updateData);
            }
        });
    });
</script>



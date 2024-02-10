
<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    .mid {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top:1em;
    }


    .rocker {
    display: inline-block;
    position: relative;
    font-size: 1.5em; /* Adjusted font-size for better responsiveness */
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
    color: #888;
    width: 7em;
    height: 4em;
    overflow: hidden;
    border-bottom: 0.5em solid #eee;
    }
    .rocker-small {
      font-size: 0.75em; /* Sizes the switch */
      margin: 1em;
    }

    .rocker::before {
      content: "";
      position: absolute;
      top: 0.5em;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #999;
      border: 0.5em solid #eee;
      border-bottom: 0;
    }

    .rocker input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .switch-left,
    .switch-right {
      cursor: pointer;
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 2.5em;
      width: 3em;
      transition: 0.2s;
    }

    .switch-left {
      height: 2.4em;
      width: 2.75em;
      left: 0.85em;
      bottom: 0.4em;
      background-color: #ddd;
      transform: rotate(15deg) skewX(15deg);
    }

    .switch-right {
      right: 0.5em;
      bottom: 0;
      background-color: #bd5757;
      color: #fff;
    }

    .switch-left::before,
    .switch-right::before {
      content: "";
      position: absolute;
      width: 0.4em;
      height: 2.45em;
      bottom: -0.45em;
      background-color: #ccc;
      transform: skewY(-65deg);
    }

    .switch-left::before {
      left: -0.4em;
    }

    .switch-right::before {
      right: -0.375em;
      background-color: transparent;
      transform: skewY(65deg);
    }

    input:checked + .switch-left {
      background-color: #0084d0;
      color: #fff;
      bottom: 0px;
      left: 0.5em;
      height: 2.5em;
      width: 3em;
      transform: rotate(0deg) skewX(0deg);
    }

    input:checked + .switch-left::before {
      background-color: transparent;
      width: 3.0833em;
    }

    input:checked + .switch-left + .switch-right {
      background-color: #ddd;
      color: #888;
      bottom: 0.4em;
      right: 0.8em;
      height: 2.4em;
      width: 2.75em;
      transform: rotate(-15deg) skewX(-15deg);
    }

    input:checked + .switch-left + .switch-right::before {
      background-color: #ccc;
    }

    /* Keyboard Users */
    input:focus + .switch-left {
      color: #333;
    }

    input:checked:focus + .switch-left {
      color: #fff;
    }

    input:focus + .switch-left + .switch-right {
      color: #fff;
    }

    input:checked:focus + .switch-left + .switch-right {
      color: #333;
    }

</style>

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
<!-- Main content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-md-5">
            <div class="row">
                <!-- INFO -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            PLANT INFORMATION
                        </div>
                        <div class="card-body">
                                        <form class="row g-3" method="post" action="code.php">
                                            <!-- Plant Name -->
                                            <div class="col-md-6">
                                                <label for="plantName" class="form-label">Plant Name:</label>
                                                <input type="text" class="form-control" id="plantName" placeholder="Lettuce" disabled selected value="<?= $getData['plant_name']; ?>">
                                            </div>
                                            <!-- Required pH Level -->
                                            <div class="col-md-6">
                                                <label for="requiredPh" class="form-label">Required pH Level:</label>
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

                                            <!-- Date Harvested -->
                                            <div class="col-md-6">
                                                <label>Estimated Date Harvested</label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control datetimepicker-input" id="dateHarvested" disabled selected value="<?= $getData['date_harvest']; ?>" />
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
                                                <select class="form-control" name="plant_status" disabled>
                                                    <option value="Planted" <?= ($getData['plant_status'] == 'Planted') ? 'selected' : '' ?>>Planted</option>
                                                    <option value="Harvested" <?= ($getData['plant_status'] == 'Harvested') ? 'selected' : '' ?>>Harvested</option>
                                                    <option value="Withered" <?= ($getData['plant_status'] == 'Withered') ? 'selected' : '' ?>>Withered</option>
                                                </select>
                                            </div>
                                        </form>
                                        <br>
                                        <br><br>
                                    </div>
                                </div>
                            </div>

                        <!-- HTML Structure -->
                        <div class="col-lg-8 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    CONTROLLER
                                </div>
                                <!-- <div class="card-body"> -->
                                    <!-- Plant details -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <!-- switch for low -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="pics/low.png" width="300px" height="300px" class="mr-3">
                                                <!-- Switch for low -->
                                                <label class="rocker">
                                                    <input type="checkbox" id="relay1Checkbox" checked onchange="toggleRelay(1)">
                                                    <span class="switch-left">On</span>
                                                    <span class="switch-right">Off</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- switch for high -->
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="pics/high.png" width="300px" height="300px" class="mr-3">
                                                <!-- Switch for high -->
                                                <label class="rocker">
                                                    <input type="checkbox" id="relay2Checkbox" checked onchange="toggleRelay(2)">
                                                    <span class="switch-left">On</span>
                                                    <span class="switch-right">Off</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <!-- Interactive chart -->
                <div class="col-lg-12">
                <div class="row">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Realtime PH Level Result
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="interactive" style="height: 320px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

        <?php

}else{
    $_SESSION['status'] = "Invalid ID!";
    header('Location: index.php');
    exit();
}

}else{
$_SESSION['status'] = "No Record Found!";
header('Location: index.php');
exit();
}

?>


    <!-- <button id="relay1Button" onclick="toggleRelay(1)">Toggle Relay 1</button>

    <button id="relay2Button" onclick="toggleRelay(2)">Toggle Relay 2</button> -->

    </section>


      </div>
    </div>

</body>
</html>

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
function updateUI(relayNumber, relayStatus) {
    const checkboxId = `relay${relayNumber}Checkbox`;
    const checkbox = document.getElementById(checkboxId);

    // Update checkbox state based on relay status
    checkbox.checked = relayStatus === 'on';

    // Update other UI elements as needed
}

// Function to toggle Relay
function toggleRelay(relayNumber) {
    // Get the current state of both relays from Firebase
    Promise.all([
        database.ref(`/relay/1`).once('value'),
        database.ref(`/relay/2`).once('value')
    ]).then(snapshots => {
        const relay1Status = snapshots[0].val();
        const relay2Status = snapshots[1].val();

        // Determine the new command based on the current state
        const newCommand = relay1Status === 'on' || relay2Status === 'on' ? 'off' : 'on';

        // Update the relay status in the Firebase database
        database.ref(`/relay/${relayNumber}`).set(newCommand);
    });
}

// Monitor changes in the relay status and update the UI
function monitorRelayStatus(relayNumber) {
    const relayRef = database.ref(`/relay/${relayNumber}`);

    relayRef.on('value', snapshot => {
        const relayStatus = snapshot.val();
        updateUI(relayNumber, relayStatus);
    });
}

// Call monitorRelayStatus for each relay you want to monitor
monitorRelayStatus(1);
monitorRelayStatus(2);

// Disable the other checkbox if one is checked
document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const otherCheckbox = this.id === 'relay1Checkbox' ? document.getElementById('relay2Checkbox') : document.getElementById('relay1Checkbox');
        otherCheckbox.disabled = this.checked;
    });
});
</script>




<?php
include('includes/footer.php');
?>

<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/plugins/jquery.flot.pie.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>


<!-- RealTime Ph lvl Chart -->

<script>
$(function () {
    var maxDataPoints = 10;
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

                    var xValues = Array.from({ length: slicedPhValues.length }, (_, i) => i);

                    var trace = {
                        x: xValues,
                        y: slicedPhValues,
                        type: 'scatter',
                        mode: 'lines+markers+text', // Add text to the lines and markers
                        line: { width: 2, shape: 'spline' },
                        text: slicedPhValues, // Dislay pH result as text
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
                        yaxis: { range: [Math.min(...slicedPhValues) - 0.1, Math.max(...slicedPhValues) + 0.1] }
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

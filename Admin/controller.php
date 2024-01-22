
<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    html {
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
      font-size: 100%;
    }
    *, *:before, *:after {
      box-sizing: inherit;
      margin:0;
      padding:0;
    }
    .mid {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top:1em;
    }


    /* Switch starts here */
    .rocker {
      display: inline-block;
      position: relative;
      /*
      SIZE OF SWITCH
      ==============
      All sizes are in em - therefore
      changing the font-size here
      will change the size of the switch.
      See .rocker-small below as example.
      */
      font-size: 2em;
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
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Controller</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
<!--             <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
    // Fetch plant names from Firebase
$plantNames = [];
$plantsRef = $database->getReference('/plants');
$plantData = $plantsRef->getSnapshot()->getValue();

if ($plantData) {
    foreach ($plantData as $plantId => $plantInfo) {
        $plantNames[$plantId] = $plantInfo['plant_name'];
    }
}
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Dropdown to select plant -->
            <div class="col-xl-6">
              <div class="card mb-4">
               <div class="card-header">
                    <label for="plantSelect">Select Plant:</label>
                    <select class="form-control" id="plantSelect" onchange="updatePlantInfo()">
                        <option value="" disabled selected>Select a plant</option>
                        <?php
                        foreach ($plantNames as $plantId => $plantName) {
                            echo "<option value='$plantId'>$plantName</option>";
                        }
                        ?>
                    </select>
                </div>



              <div class="card mb-4">
               <div class="card-header">
                PLANT INFORMATION
              </div>
              <div class="modal-body">
                <form class="row g-3">
                 <!-- Plant Name -->
                 <div class="col-md-6">
                  <label for="plantName" class="form-label">Plant Name:</label>
                  <input type="text" class="form-control" id="plantName" placeholder="Lettuce" disabled>
                </div>
                <!-- Required pH Level -->
                <div class="col-md-6">
                  <label for="requiredPh" class="form-label">Required pH Level:</label>
                  <input type="text" class="form-control" id="requiredPh" placeholder="5.5 to an upper limit of pH 7.0" disabled>
                </div>

                <!-- Date Planted-->
                <form class="row g-3">
                 <div class="col-md-6">
                  <br>
                  <label>Date Planted</label>
                  <div class="input-group date">
                    <input type="text" class="form-control datetimepicker-input" id="datePlanted" disabled>
                    <div class="input-group-append" data-target="#reservationdate">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>

                <!-- Date Harvested-->
                <form class="row g-3">
                 <div class="col-md-6">
                  <br>
                  <label>Estimated Date Harvested</label>
                  <div class="input-group date">
                    <input type="text" class="form-control datetimepicker-input" id="dateHarvested" disabled>
                    <div class="input-group-append" data-target="#reservationdate">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>


                <form class="row g-3">
                 <div class="col-md-6">
                  <br>
                  <label>Plant Status</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control" id="plantStatus" placeholder="planted" disabled>
                  </div>
                </div>


                <form class="row g-3">
                 <div class="col-md-3">
                  <br>
                  <label>BAY</label>
                  <div class="input-group date" id="reservationdate">
                    <input type="text" class="form-control" id="bay" placeholder="BAY" disabled >
                  </div>
                </div>

                  <form class="row g-3">
                 <div class="col-md-3">
                  <br>
                  <label>NFT</label>
                  <div class="input-group date" id="reservationdate">
                    <input type="text" class="form-control" id="nft" placeholder="NFT"  disabled>
                  </div>
                </div>

                </div>
              </div>
            </div>
            </div>

            <div class="col-6">

      <div class="mid">
        <img src="pics/low.png" width="300px" heigh="300px">
      <label class="rocker">
    <input type="checkbox" id="relay1Button" checked>
    <span class="switch-left" onclick="toggleRelay(1)">On</span>
    <span class="switch-right" onclick="toggleRelay(1)">Off</span>
  </label>

  <img src="pics/high.png" width="300px" heigh="300px">
      <label class="rocker">
    <input type="checkbox" id="relay2Button" checked>
    <span class="switch-left" onclick="toggleRelay(2)">On</span>
    <span class="switch-right" onclick="toggleRelay(2)">Off</span>
  </label>
  </div>
  </div>

            <div class="col-12">
                <!-- interactive chart -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                          Realtime PH Level Result
                        </h3>
                        <div class="card-tools">
                            <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="interactive" style="height: 450px;"></div>
                    </div>
                    <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>


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

  // Function to toggle Relay
  function toggleRelay(relayNumber) {
      // Get the current state of the relay from Firebase
      database.ref(`/relay/${relayNumber}`).once('value').then(snapshot => {
          const relayStatus = snapshot.val();

          // Determine the new command based on the current state
          const newCommand = relayStatus === 'on' ? 'off' : 'on';

          // Update the relay status in the Firebase database
          database.ref(`/relay/${relayNumber}`).set(newCommand);
      });
  }

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



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updatePlantInfo() {
        var selectedPlantId = $('#plantSelect').val();

        // Make an AJAX request to fetch plant data based on the selected plant ID
        $.ajax({
            url: 'get_plant_data.php', // Create a PHP script to handle this request
            type: 'POST',
            data: { plantId: selectedPlantId },
            success: function (data) {
                // Parse the returned JSON data and update the input fields
                var plantData = JSON.parse(data);
                $('#plantName').val(plantData.plant_name);
                $('#requiredPh').val(plantData.ph_lvl_low + ' - ' + plantData.ph_lvl_high);
                $('#datePlanted').val(plantData.date_planted);
                $('#dateHarvested').val(plantData.date_harvest);
                $('#plantStatus').val(plantData.date_status);
                $('#bay').val(plantData.bay);
                $('#nft').val(plantData.nft);

            }
        });
    }
</script>



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

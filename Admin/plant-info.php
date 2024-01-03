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
                    <!-- <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0">Plant Info</h1>
                      </div>
                    </div> -->
                    <div class="row mb-3">
                      <div class="col-md-3">
                      <ol class="breadcrumb float-sm-left">
                      </ol>
                    </div>
                  </div>
                </div>
                <?php
                    if(isset($_GET['id']))
                    {
                        $key_child = $_GET['id'];

                        $ref_table = 'plants';
                        $getData = $database->getReference($ref_table)->getChild($key_child)->getValue();

                        if($getData > 0)
                        {
                            ?>

    <!-- Main content -->
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <!-- Main content -->
          <div class="row">
            <div class="col-xl-3">
              <div class="card mb-4">
                <div class="row">
                  <div class="col-md-12">
                  <div class="card-header">
                  <?= $getData['plant_name']; ?>
              </div>
                  </div>
                </div>
                  <div class="col-sm-12 text-center">
                    <div class="card-body">
                    <?php
                // Check if the 'plant_photo' key exists in the data
                if (isset($getData['plant_photo'])) {
                    $plantPhotoURL = $getData['plant_photo'];
                    ?>
                    <img src="<?= $plantPhotoURL ?>" alt="Plant Photo" style="max-width: 300px;">
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
            </div>


            <!-- INFO -->
            <div class="col-xl-6">
              <div class="card mb-4">
               <div class="card-header">
                PLANT INFORMATION
              </div>
              <div class="modal-body">
                <form class="row g-3">
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

                <!-- Date Planted-->
                <form class="row g-3">
                 <div class="col-md-6">
                  <br>
                  <label>Date Planted</label>
                  <div class="input-group date">
                    <input type="text" class="form-control datetimepicker-input" id="datePlanted" disabled selected value="<?= $getData['date_planted']; ?>"/>
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
                    <input type="text" class="form-control datetimepicker-input" id="dateHarvested" disabled selected value="<?= $getData['date_harvest']; ?>"/>
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
                    <input type="text" class="form-control" id="dateHarvested" placeholder="November 17, 2023" disabled selected value="<?= $getData['plant_status']; ?>" data-target="#reservationdate"/>
                  </div>
                </div>


                <form class="row g-3">
                 <div class="col-md-3">
                  <br>
                  <label>BAY</label>
                  <div class="input-group date" id="reservationdate">
                    <input type="text" class="form-control" id="dateHarvested" placeholder="November 17, 2023" disabled selected value="<?= $getData['bay']; ?>"/>
                  </div>
                </div>

                  <form class="row g-3">
                 <div class="col-md-3">
                  <br>
                  <label>NFT</label>
                  <div class="input-group date" id="reservationdate">
                    <input type="text" class="form-control"  disabled selected value="<?= $getData['nft']; ?>"/>
                  </div>
                </div>



                </div>
              </div>
            </div>

          <div class="row">
            <div class="col-12">
              <div class="card-body">
                <div class="text-center">
                  <input type="text"
                  class="knob" value="39" data-skin="tron"
                  data-thickness="0.2" data-width="250" data-height="250"
                  data-fgColor="#2C3090">
                  <div class="knob-label"><b>Days before Harvest</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>

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

                if ($latestPhValue > $requiredHighPhLevel) {
                    $notificationsRef = $database->getReference('/notifications')->push();
                    $notificationsRef->set([
                        'plant_name' => $plantInfo['plant_name'],
                        'plant_photo' => $plantInfo['plant_photo'],
                        'message' => "High pH Level: $latestPhValue",
                        'current_date' => date('H:i A, M j, Y'),
                        'isRead' => 0,
                      ]);
                    echo 'Notification created: ' . $notificationsRef->getKey() . PHP_EOL;
                } elseif ($latestPhValue < $requiredLowPhLevel) {
                    $notificationsRef = $database->getReference('/notifications')->push();
                    $notificationsRef->set([
                        'plant_name' => $plantInfo['plant_name'],
                        'plant_photo' => $plantInfo['plant_photo'],
                        'message' => "Low pH Level: $latestPhValue",
                        'current_date' => date('H:i A, M j, Y'),
                        'isRead' => 0,
                      ]);
                    // echo 'Notification created: ' . $notificationsRef->getKey() . PHP_EOL;
                } else {
                    // echo 'pH value is within the acceptable range for ' . $plantInfo['plant_name'] . '.' . PHP_EOL;
                }
            }

            // Call the pH level check function
            checkPhLevel($requiredLowPhLevel, $requiredHighPhLevel, $database, $plantInfo);
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
                        <div id="interactive" style="height: 350px;"></div>
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
setInterval(checkNotifications, 3000); // 3000 milliseconds = 3 seconds, adjust as needed
</script>


<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>




<!-- RealTime Ph lvl Chart -->

<script>
$(function () {
    var maxDataPoints = 10;
    var chart;

    function updateChart() {
        $.ajax({
            url: 'ph-sensor-result.php', // Update with the correct endpoint
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
                        text: slicedPhValues, // Display pH result as text
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

    // Start updating chart
    updateChart();

    // Toggle chart updating
    $('#realtime .btn').click(function () {
        if ($(this).data('toggle') === 'on') {
            updateChart();
        } else {
            // Clear the update interval
            clearTimeout(updateChart);
        }
    });
});
</script>

<!-- Harvest Chart -->

</script>

    <!-- jQuery Knob -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>

    <script>

  $(function () {
    /* jQueryKnob */
    $('.knob').knob({
        draw: function () {
          // "tron" case
          if (this.$.data('skin') == 'tron') {

        var a   = this.angle(this.cv)  // Angle
        ,
            sa  = this.startAngle          // Previous start angle
            ,
            sat = this.startAngle         // Start angle
            ,
            ea                            // Previous end angle
            ,
            eat = sat + a                 // End angle
            ,
            r   = true

            this.g.lineWidth = this.lineWidth

            this.o.cursor
            && (sat = eat - 0.3)
            && (eat = eat + 0.3)

            if (this.o.displayPrevious) {
              ea = this.startAngle + this.angle(this.value)
              this.o.cursor
              && (sa = ea - 0.3)
              && (ea = ea + 0.3)
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
        $('.knob').val(daysBeforeHarvest).trigger('change');
        $('.knob-label').html('<b>Days before Harvest</b>');
    }

    updateDaysBeforeHarvest(); // Initial update

    // Set up a timer to update the Knob chart every 24 hours (adjust as needed)
    setInterval(updateDaysBeforeHarvest, 24 * 60 * 60 * 1000); // 24 hours in milliseconds
});
</script>





<?php
include('admin_auth.php'); // Include the file that contains authorization logic
include('includes/header.php');
include('includes/navbar.php');
?>

  <!-- Content Wrapper. Contains page content -->
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
            ?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>

                <?php
                        $ref_table = 'plants';
                        $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                        echo $total_count;
                        ?>
                </h3>

                <p>Registered Plants</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-seedling"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">

                <h3>
                <?php
              $ref_table = 'plants';
              $total_harvested = 0;

              $plants_ref = $database->getReference($ref_table);

              // Loop through each plant
              foreach ($plants_ref->getValue() as $key => $plant) {
                  // Check if the plant_status is Harvested
                  if (isset($plant['plant_status']) && $plant['plant_status'] === 'Harvested') {
                      $total_harvested++;
                  }
              }
              ?>

                <?php echo $total_harvested;?>
                <sup style="font-size: 20px"></sup>
              </h3>

                <p>Harvested Plants</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-h"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php
          $users = iterator_to_array($auth->listUsers());
          // Get the total number of registered users
          $numberOfUsers = count($users);
          ?>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?= $numberOfUsers ?></h3>
                <p>Registered Users</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>
                <?php
              $ref_table = 'plants';
              $total_withered = 0;

              $plants_ref = $database->getReference($ref_table);

              // Loop through each plant
              foreach ($plants_ref->getValue() as $key => $plant) {
                  // Check if the plant_status is Harvested
                  if (isset($plant['plant_status']) && $plant['plant_status'] === 'Withered') {
                      $total_withered++;
                  }
              }
              echo $total_withered;
              ?>

                  </h3>
            <p>Withered Plants</p>
        </div>
        <div class="icon">
            <i class="fa-solid fa-plant-wilt"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->

        <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- interactive chart -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Realtime PH Level Result
                        </h3>
                        <div class="card-tools">
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


            <?php
              $ref_table = 'plants';
              $total_Planted = 0;

              $plants_ref = $database->getReference($ref_table);

              // Loop through each plant
              foreach ($plants_ref->getValue() as $key => $plant) {
                  // Check if the plant_status is Harvested
                  if (isset($plant['plant_status']) && $plant['plant_status'] === 'Planted') {
                      $total_Planted++;
                  }
              }
              ?>


<?php
        // Initialize arrays to store the count of plants for each month and status
        $months = [];
        $plantedByMonth = [];
        $harvestedByMonth = [];
        $witheredByMonth = [];

        $ref_table = 'plants';
        $plants_ref = $database->getReference($ref_table);

        // Loop through each plant
        foreach ($plants_ref->getValue() as $key => $plant) {
            // Check if date_planted is set and not empty
            if (isset($plant['date_planted']) && !empty($plant['date_planted'])) {
                // Get the month from the date_planted field
                $month = date('n', strtotime($plant['date_planted']));
                // Increment the count for the corresponding month
                if (!in_array($month, $months)) {
                    // If the month is not already in the array, add it
                    $months[] = $month;
                    // Initialize counts for this month
                    $plantedByMonth[$month] = 0;
                    $harvestedByMonth[$month] = 0;
                    $witheredByMonth[$month] = 0;
                }
                // Increment the count for the corresponding status and month
                if ($plant['plant_status'] === 'Planted') {
                    $plantedByMonth[$month]++;
                } elseif ($plant['plant_status'] === 'Harvested') {
                    $harvestedByMonth[$month]++;
                } elseif ($plant['plant_status'] === 'Withered') {
                    $witheredByMonth[$month]++;
                }
            }
        }
?>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Monthly Update</h3>
            <div class="card-tools">
                <select id="filterDropdown" class="form-control">
                     <option value="all">All</option>
                        <?php
                        foreach ($months as $month) {
                        echo "<option value='$month'>" . date("F", mktime(0, 0, 0, $month, 1)) . "</option>";
                        }
                        ?>
                        </select>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
                <!-- Clock chart -->
                <div class="item3">
                    <div id="clock"></div>
                </div>
            </div>
        </div>
    </div>
</section>


</div>
</div>



<?php
include('includes/footer.php');
?>

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



<!-- areaChartData -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var months = <?php echo json_encode(array_keys($months)); ?>;
    var plantedByMonth = <?php echo json_encode(array_values($plantedByMonth)); ?>;
    var harvestedByMonth = <?php echo json_encode(array_values($harvestedByMonth)); ?>;
    var witheredByMonth = <?php echo json_encode(array_values($witheredByMonth)); ?>;

    // Calculate the total sum of plants planted, harvested, and withered across all months
    var totalPlanted = plantedByMonth.reduce((a, b) => a + b, 0);
    var totalHarvested = harvestedByMonth.reduce((a, b) => a + b, 0);
    var totalWithered = witheredByMonth.reduce((a, b) => a + b, 0);

    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
          yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        max: 20, // Set the maximum value for the y-axis
                        stepSize: 5 // Set step size to 1 to display only whole numbers
            }
            }]
        },
        plugins: {
            datalabels: {
                anchor: 'end',
                align: 'end',
                color: '#000',
                font: {
                    weight: 'bold'
                },
                formatter: function(value, context) {
                    return context.chart.data.datasets[context.datasetIndex].label;
                }
            }
        }
    };

    var barChart;

    function updateChart(month) {
        var barChartData;

        if (month === 'all') {
            // Display the total sum of planted, harvested, and withered across all months
            barChartData = {
                datasets: [{
                        label: 'Planted',
                        backgroundColor: '#00a65a',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: '#c1c7d1',
                        pointStrokeColor: 'rgba(210, 214, 222, 1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [totalPlanted],
                    },
                    {
                        label: 'Harvested',
                        backgroundColor: '#0073b7',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [totalHarvested]
                    },
                    {
                        label: 'Withered',
                        backgroundColor: '#f56954',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [totalWithered]
                    }
                ]
            };
        } else {
            // Display data for the selected month
            barChartData = {
                datasets: [{
                        label: 'Planted',
                        backgroundColor: '#00a65a',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: '#c1c7d1',
                        pointStrokeColor: 'rgba(210, 214, 222, 1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [plantedByMonth[month - 1]],
                    },
                    {
                        label: 'Harvested',
                        backgroundColor: '#0073b7',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [harvestedByMonth[month - 1]]
                    },
                    {
                        label: 'Withered',
                        backgroundColor: '#f56954',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [witheredByMonth[month - 1]]
                    }
                ]
            };
        }

        if (barChart) {
            barChart.destroy();
        }

        barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });
    }

    $('#filterDropdown').on('change', function () {
        var selectedMonth = $(this).val();
        updateChart(selectedMonth);
    });

    // Initial chart display
    updateChart('all'); // Show all data by default
});
</script>



 <!-- Clock -->
<script>
      function updateClock() {
  var now = new Date();
            var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            var monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var dayOfWeek = daysOfWeek[now.getDay()];
            var month = monthsOfYear[now.getMonth()];
            var dayOfMonth = now.getDate();
            var year = now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';

            hours = hours % 12;
            hours = hours ? hours : 12; // The hour '0' should be '12'

            var formattedTime = dayOfWeek + ', ' + month + ' ' + dayOfMonth + ', ' + year + ', ' +
                                hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' +
                                (seconds < 10 ? '0' : '') + seconds + ' ' + ampm;

            document.getElementById('clock').innerHTML = formattedTime;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial call to display the clock immediately
        updateClock();
    </script>



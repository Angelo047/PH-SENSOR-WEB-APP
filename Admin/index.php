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
            <div class="small-box bg-info">
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
              ?>
                  <?php echo $total_withered;?>

                <p>Withered Plants</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Weekly Update</h3>
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

<!-- areaChartData -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
      // Updated areaChartData with reversed dataset order
    var areaChartData = {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
      datasets: [
      {
        label: 'High pH Level',
        backgroundColor: '#0057b2',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: '#c1c7d1',
        pointStrokeColor: 'rgba(210, 214, 222, 1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [65, 59, 80, 81, 56, 100, 68],
      },
      {
        label: 'Low pH Level',
        backgroundColor: '#FF7B5F',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [28, 48, 40, 19, 30, 45, 30]
      },
      ]
    };

      // BAR CHART
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    });
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



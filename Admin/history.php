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
				<div class="col-sm-6">
					<h1 class="m-0">History</h1>
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


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <!-- BAR CHART -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Weekly Report</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart"
                      style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>


          <div class="row">
            <div class="col-12">
              <div class="card card-outline">
                <div class="card-body">
                  <div class="row justify-content-end">
                    <div class="col-auto">
                    </div>
                    <div class="col-2">
                      <div class="input-group">
                        <input class="form-control" type="text" id="searchInput" placeholder="Search..."
                          aria-label="Search">
                      </div>
                    </div>
                  </div>
                  <br>

                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Plant Name</th>
                          <th>Date</th>
                          <th>Alert Time</th>
                          <th>Alert Water pH Level</th>
                          <th>Time Resolved</th>
                          <th>PH Level</th>
                          <th>Facilitator</th>
                          <th>Total Time Resolved</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lettuce</td>
                          <td>9/15/23</td>
                          <td>4:28 AM</td>
                          <td style="color: #0057B2;"><b>7</b></td>
                          <td>5:00 AM</td>
                          <td style="color: green;"><b>6</b></td>
                          <td>Marie</td>
                          <td>32 Minutes</td>
                        </tr>
                        <tr>
                          <td>Spinach</td>
                          <td>10/15/23</td>
                          <td>4:28 AM</td>
                          <td style="color: #FF7B5F;"><b>5</b></td>
                          <td>5:00 AM</td>
                          <td style="color: green;"><b>6</b></td>
                          <td>Pino</td>
                          <td>12 Minutes</td>
                        </tr>
                        <tr>
                          <td>Lettuce</td>
                          <td>9/15/23</td>
                          <td>4:28 AM</td>
                          <td style="color: #0057B2;"><b>7</b></td>
                          <td>5:00 AM</td>
                          <td style="color: green;"><b>6</b></td>
                          <td>Marichelle</td>
                          <td>22 Minutes</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div id="searchFeedback" class="col-3 mt-2" style="display: none; color: red;">
                    No matching results found.
                  </div>




                </div>
              </div>
            </div>
      </section>
    </div>
  </div>
  <!-- ./wrapper -->



	</div>
</div>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('searchInput');
      const table = document.getElementById('example1');
      const searchFeedback = document.getElementById('searchFeedback');

      searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        let noMatches = true;

        rows.forEach(row => {
          const dataCells = row.querySelectorAll('td');
          let rowMatchesSearch = false;

          dataCells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
              rowMatchesSearch = true;
            }
          });

          if (rowMatchesSearch) {
            row.style.display = '';
            noMatches = false;
          } else {
            row.style.display = 'none';
          }
        });

        // Show or hide the "No matching results found" message
        if (noMatches) {
          searchFeedback.style.display = 'block';
        } else {
          searchFeedback.style.display = 'none';
        }
      });
    });
  </script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
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



<?php
include('includes/footer.php');
?>

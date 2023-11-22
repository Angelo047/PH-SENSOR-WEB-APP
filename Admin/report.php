<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-6">
       <h1 class="m-0">Report</h1>
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
              <div class="col-12">
                <div class="card card-outline">
                 <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                   <thead>
                    <tr>
                     <th>No</th>
                     <th>Plant Name</th>
                     <th>Harvested Plants</th>
                     <th>Withered Plants</th>
                   </tr>
                 </thead>
                 <tbody>
                  <tr>
                   <td>1</td>
                   <td>Lettuce</td>
                   <td>5</td>
                   <td>1</td>
                 </tr>
                 <tr>
                   <td>2</td>
                   <td>Spinach</td>
                   <td>3</td>
                   <td>1</td>
                 </tr>
               </tbody>
             </table>
             <br>
             <a href="narativereport.php">
               <button type="button" class="btn" style="float: right; width: 220px; background-color: #2C3090; color: #FFFFFF;">Create Narative Report</button>
             </a>
           </div>
         </div>









       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
 </section>
 <!-- /.content -->
</div>
<!-- /.content-wrapper -->

	</div>
</div>


<?php
include('includes/footer.php');
?>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "ordering": false,
      "paging": false,
      "buttons": [
        {
          extend: 'excel',
          className: 'btn-custom-color', // Apply custom class
        },
        {
          extend: 'pdf',
          className: 'btn-custom-color', // Apply custom class
        },
        {
          extend: 'print',
          className: 'btn-custom-color', // Apply custom class
        },
        {
          extend: 'colvis',
          className: 'btn-custom-color', // Apply custom class
        }
      ],
      "searching": true,
      "language": {
        "search": "", // Remove the "Search:" label
        "searchPlaceholder": "Search...", // Set the placeholder text
      },
      "info": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "search": "", // Remove the "Search:" label
        "searchPlaceholder": "Search...", // Set the placeholder text
      },
    });
  });
</script>



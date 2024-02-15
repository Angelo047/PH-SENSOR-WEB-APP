<?php
include('admin_auth.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
  .table th {
    text-align: center;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h1 class="card-title">Water pH</h1>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped" id="myTable">
                                <!-- Table headers -->
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Facilitator</th>
                                        <th class="text-center">Time & Date</th>
                                        <th class="text-center">PH Level</th>
                                        <th class="text-center">Plant Name</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <!-- Table body -->
                                <tbody>
                                    <?php
                                    $ref_table = 'notifications';
                                    $fetchdata = $database->getReference($ref_table)->getValue();
                                    if (!empty($fetchdata)) {
                                        $i = 1;
                                        foreach ($fetchdata as $row) {
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $i++; ?></td>
                                                <td><?= !empty($row['Facilitator']) ? $row['Facilitator'] : ''; ?></td>
                                                <td><?= !empty($row['current_date']) ? $row['current_date'] : ''; ?></td>
                                                <td><?= !empty($row['ph_lvl']) ? $row['ph_lvl'] : ''; ?></td>
                                                <td><?= !empty($row['plant_name']) ? $row['plant_name'] : ''; ?></td>
                                                <td><?= !empty($row['status']) ? $row['status'] : ''; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-12 mt-2 searchFeedback" style="display: none; color: red;">
                                No matching results found.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Second table for Plants -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h1 class="card-title">Plants</h1>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped" id="myTable2">
                                <!-- Table headers -->
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">BAY</th>
                                        <th class="text-center">Date Planted</th>
                                        <th class="text-center">Claimed Date</th>
                                        <th class="text-center">NFT</th>
                                        <th class="text-center">Water pH level range</th>
                                        <th class="text-center">Plant Name</th>
                                        <th class="text-center">Plant Status</th>
                                    </tr>
                                </thead>
                                <!-- Table body -->
                                <tbody>
                                    <?php
                                    $ref_table = 'plants';
                                    $fetchdata = $database->getReference($ref_table)->getValue();
                                    if (!empty($fetchdata)) {
                                        $i = 1;
                                        foreach ($fetchdata as $row) {
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $i++; ?></td>
                                                <td><?= !empty($row['bay']) ? $row['bay'] : ''; ?></td>
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
                                                        </td>                                               <td><?= !empty($row['nft']) ? $row['nft'] : ''; ?></td>
                                                <td><?= !empty($row['ph_lvl_low']) && !empty($row['ph_lvl_high']) ? $row['ph_lvl_low'] . ' - ' . $row['ph_lvl_high'] : ''; ?></td>
                                                <td><?= !empty($row['plant_name']) ? $row['plant_name'] : ''; ?></td>
                                                <td><?= !empty($row['plant_status']) ? $row['plant_status'] : ''; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">No Record Found</td>
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
    </section>
</div>


<?php
include('includes/footer.php');
?>



<script>
    $(document).ready(function() {
    // Check if DataTables is already initialized on the table
    if (!$.fn.DataTable.isDataTable('#myTable')) {
        // DataTables is not initialized, so initialize it
        $('#myTable').DataTable({
          pageLength = 5,
        });
    }
});

</script>


<script>
   $(document).ready(function() {
    // Check if DataTables is already initialized on the table
    if (!$.fn.DataTable.isDataTable('#myTable2')) {
        // DataTables is not initialized, so initialize it
        $('#myTable2').DataTable({
          pageLength = 5,
        });
    }
});

</script>

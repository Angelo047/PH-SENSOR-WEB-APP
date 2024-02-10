<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>


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
    <?php
        $uid = $_SESSION['verified_user_id'];
        $user = $auth->getUser($uid);
        ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="col-md-12">
          <div class="card card-outline">
            <div class="card-header">
              <h3 class="card-title">
                Compose Narrative Report
              </h3>
            </div>

            <?php
                    if(isset($_GET['id']))
                    {
                        $key_child = $_GET['id'];

                        $ref_table = 'plants';
                        $getData = $database->getReference($ref_table)->getChild($key_child)->getValue();

                        $currentDateTime = date('F j, Y'); // You can customize the format

                        if($getData > 0)
                        {
                            ?>
                                      <!-- /.card-header -->
            <div class="card-body">

            <style>
              form {
                max-width: 800px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              }

              h3 {
                color: #4CAF50;
              }

              p {
                margin-bottom: 10px;
              }

              textarea {
                width: 100%;
                height: 80px; /* Set the desired height for textarea */
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
                margin-bottom: 20px;
                padding: 8px;
                resize: none;
              }

              label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
              }

              .row {
                display: flex;
                justify-content: space-between;
              }

              .column {
                width: 48%;
                padding-left: 8px;
              }

              .two-columns {
                display: flex;
                justify-content: space-between;
              }

              .two-columns .column {
                width: 48%;
                padding-left: 8px;
              }
            </style>

            <form id="compose-textarea">
              <div class="row">
                <div class="column">
                  <h3>Plant Information</h3>
                  <p><strong>Plant Name:</strong> <?= $getData['plant_name']; ?></p>
                  <p><strong>Required pH Level:</strong> <?= $getData['ph_lvl_low']; ?>-<?= $getData['ph_lvl_high']; ?></p>
                </div>
                <div class="column">
                  <h3>Cultivation Timeline</h3>
                  <p><strong>Date Planted:</strong> <?= $getData['date_planted']; ?></p>
                  <p><strong>Estimated Date Harvested:</strong> <?= $getData['date_harvest']; ?></p>
                </div>
              </div>

              <h3>Plant Status</h3>
              <p><strong>Current Health Status:</strong> <?= $getData['plant_status']; ?></p>
              <label for="recentChanges"><strong>Recent Changes: </strong></label>
              <textarea class="form-control" rows="2" cols="50" maxlength="250" placeholder="Describe any recent changes in the plant's growth, appearance, or health."></textarea>

              <h3>Growing Systems</h3>
              <p id="baySystem"><strong><?= $getData['bay']; ?> System</strong></p>
              <div class="two-columns">
                <div class="column">
                  <label for="bay_systemOverview"><strong>System Overview: </strong></label>
                  <textarea class="form-control" rows="2" cols="25" maxlength="250" placeholder="Briefly describe the BAY system in use."></textarea>
                </div>
                <div class="column">
                  <label for="bay_performance"><strong>Performance: </strong></label>
                  <textarea class="form-control" rows="2" cols="25" maxlength="250" placeholder="Report on the effectiveness and efficiency of the BAY system."></textarea>
                </div>
              </div>

              <p id="nftSystem"><strong><?= $getData['nft']; ?> System</strong></p>
              <div class="two-columns">
                <div class="column">
                  <label for="nft_systemOverview"><strong>System Overview: </strong></label>
                  <textarea class="form-control" rows="2" cols="25" maxlength="250" placeholder="Briefly describe the NFT system in use."></textarea>
                </div>
                <div class="column">
                  <label for="nft_performance"><strong>Performance: </strong></label>
                  <textarea class="form-control" rows="2" cols="25" maxlength="250" placeholder="Report on the effectiveness and efficiency of the NFT system."></textarea>
                </div>
              </div>

              <h3>Challenges and Solutions</h3>
              <div class="row">
                <div class="column">
                  <label for="Challenges"><strong>Challenges Encountered: </strong></label>
                  <textarea class="form-control" rows="2" cols="50" maxlength="250" placeholder="List any challenges faced during the cultivation process."></textarea>
                </div>
                <div class="column">
                  <label for="Solutions"><strong>Solutions Implemented: </strong></label>
                  <textarea class="form-control" rows="2" cols="50" maxlength="250" placeholder="Describe the solutions applied to overcome the challenges."></textarea>
                </div>
              </div>

              <h3>Recommendations</h3>
              <div class="row">
                <div class="column">
                  <label for="Improvements"><strong>Improvements: </strong></label>
                  <textarea class="form-control" rows="2" cols="50" maxlength="250" placeholder="Suggest any improvements or modifications to enhance the cultivation process."></textarea>
                </div>
                <div class="column">
                  <label for="Practices"><strong>Best Practices: </strong></label>
                  <textarea class="form-control" rows="2" cols="50" maxlength="250" placeholder="Recommend best practices based on the experience gained."></textarea>
                </div>
              </div>

              <p><strong>Prepared by:</strong> <?=$user->displayName;?></p>
              <p><strong>Date of Report:</strong> <?php echo $currentDateTime; ?></p>
            </form>
          </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
              <button type="button" class="btn btn-success" id="pdf-button" onclick="GeneratePdf()">
              <i class="fas fa-download"></i> GENERATE
              </button>

            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
</div>
<!-- ./wrapper -->
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
include('includes/footer.php');
?>

<!-- Include the jsPDF library -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"integrity= "sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"crossorigin="anonymous"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2pdf.js@0.10.1/dist/html2pdf.bundle.js"></script>

<script>

		// Function to GeneratePdf
    function GeneratePdf() {
  var element = document.getElementById('compose-textarea');
  html2pdf(element, {
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2, scrollY: 0 },
    filename: 'Narrative_Report.pdf'
  });
}


function printSummernoteContent() {
  // Get the form element
  var form = document.getElementById('compose-textarea');

  // Create a new window
  var newWindow = window.open('', '_blank');
  newWindow.document.open();
  newWindow.document.write('<html><head><title>Print</title></head><body style="font-family: Arial, sans-serif;">');

  // Add the entire form content to the new window
  newWindow.document.write(form.outerHTML);

  // Close the HTML body and document
  newWindow.document.write('</body></html>');
  newWindow.document.close();

  // Print the new window
  newWindow.print();
}

</script>
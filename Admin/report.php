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
            <h1 class="m-0">Narative Report</h1>
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
                            ?>            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                <textarea id="compose-textarea" class="form-control" rows="27 " cols="40">

              **Project Title:** [Enter Project Title]

              **Project Overview:** [Brief description of the overall goal and purpose of the plant cultivation project.]

              ---

              ### 1. Plant Information

              #### 1.1 Plant Name: <?= $getData['plant_name']; ?>

              #### 1.2 Required pH Level: <?= $getData['ph_lvl_low']; ?>-<?= $getData['ph_lvl_high']; ?>">

              ---

              ### 2. Cultivation Timeline

              #### 2.1 Date Planted: <?= $getData['date_planted']; ?>

              #### 2.2 Estimated Date Harvested: <?= $getData['date_harvest']; ?>

              ---

              ### 3. Plant Status

              #### 3.1 Current Health Status: <?= $getData['plant_status']; ?>

              #### 3.2 Recent Changes: [Describe any recent changes in the plant's growth, appearance, or health.]

              ---

              ### 4. Growing Systems

              #### 4.1 <?= $getData['bay']; ?> System

              ##### 4.1.1 System Overview: [Briefly describe the BAY system in use.]

              ##### 4.1.2 Performance: [Report on the effectiveness and efficiency of the BAY system.]

              #### 4.2 <?= $getData['nft']; ?> System

              ##### 4.2.1 System Overview: [Briefly describe the NFT system in use.]

              ##### 4.2.2 Performance: [Report on the effectiveness and efficiency of the NFT system.]

              ---

              ### 5. Challenges and Solutions

              #### 5.1 Challenges Encountered: [List any challenges faced during the cultivation process.]

              #### 5.2 Solutions Implemented: [Describe the solutions applied to overcome the challenges.]

              ---

              ### 6. Recommendations

              #### 6.1 Improvements: [Suggest any improvements or modifications to enhance the cultivation process.]

              #### 6.2 Best Practices: [Recommend best practices based on the experience gained.]

              ---

              ### 7. Conclusion

              #### 7.1 Summary: [Summarize the overall progress and outcomes of the plant cultivation project.]


              **Prepared by:** <?=$user->displayName;?>


              **Date of Report:** <?php echo $currentDateTime; ?>
                </textarea>
              </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
              <button type="button" class="btn" style="background-color: #2C3090; color: #FFFFFF;" id="pdf-button" onclick="downloadAsPDF()">
              <i class="fas fa-save"></i> PDF
              </button>

              <button type="button" class="btn" style="background-color: #2C3090; color: #FFFFFF;" id="print-button" onclick="printSummernoteContent()">
                <i class="fa-solid fa-print"></i> PRINT
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

<!-- Include the corrected jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>


<script>

function downloadAsPDF() {
  var content = document.getElementById('compose-textarea').value;

  // Create an element to hold the content
  var container = document.createElement('div');
  container.innerHTML = content;

  // Add some CSS styles to preserve spacing
  container.style.whiteSpace = 'pre-wrap';
  container.style.fontFamily = 'Arial, sans-serif';

  // Convert the content to PDF
  html2pdf(container, {
    margin: 10,
    filename: 'Narative Report.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2, preserveAspectRatio: true },
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
  });
}


  function printSummernoteContent() {
    var content = document.getElementById('compose-textarea').value;
    var newWindow = window.open('', '_blank');
    newWindow.document.open();
    newWindow.document.write('<html><head><title>Print</title></head><body style="white-space: pre-line;">' + content + '</body></html>');
    newWindow.document.close();
    newWindow.print();
  }

</script>




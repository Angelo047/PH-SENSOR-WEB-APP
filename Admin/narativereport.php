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
            <h1 class="m-0">Narative Report</h1>
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

        <div class="col-md-12">
          <div class="card card-outline">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                <textarea id="compose-textarea" class="form-control">
                </textarea>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                 <button type="button" class="btn" style="background-color: #2C3090; color: #FFFFFF;" id="save-button" onclick="saveSummernoteContent()">
                  <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn" style="background-color: #2C3090; color: #FFFFFF;" id="print-button" onclick="printSummernoteContent()">
                  <i class="fa-solid fa-print"></i> Print
                </button>
              </div>
              <button type="button" class="btn btn-default" onclick="discardContent()"><i class="fas fa-times"></i> Discard</button>
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


</div>
</div>

<?php
include('includes/footer.php');
?>

<script>
  $(function () {
    $('#compose-textarea').summernote({
      height: 500,
      placeholder: 'Compose narative here...'
    });
  });
</script>

<!-- Discard Button -->
<script>
  function discardContent() {
        // Clear the content of the Summernote editor
    $('#compose-textarea').summernote('code', '');
  }

    // Initialize Summernote
  $(document).ready(function() {
    $('#compose-textarea').summernote();
  });
</script>

<!-- Print Button -->
<script>
  function printSummernoteContent() {
    // Get the content of the Summernote editor
    var content = $('#compose-textarea').summernote('code');

    // Open a new window for printing
    var printWindow = window.open('', '_blank');

    // Write the content to the new window with text-align: justify
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<style>div { text-align: justify; }</style></head><body>');
    printWindow.document.write('<div>' + content + '</div>');
    printWindow.document.write('</body></html>');

    // Close the new window after printing
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
  }
</script>


<!-- Save Button -->
<script>
  // Load saved content when the page is ready
  $(document).ready(function() {
    loadSavedContent();
  });

  function saveSummernoteContent() {
    // Get the content of the Summernote editor
    var content = $('#compose-textarea').summernote('code');

    // Save the content to local storage
    localStorage.setItem('summernoteContent', content);

    // Display a simplified version of the content without HTML tags
    var simplifiedContent = content.replace(/<[^>]*>/g, ''); // Remove HTML tags
    alert('Content saved:\n\n' + simplifiedContent);
  }

  function loadSavedContent() {
    // Retrieve the saved content from local storage
    var savedContent = localStorage.getItem('summernoteContent');

    // Set the content in the Summernote editor
    $('#compose-textarea').summernote('code', savedContent);
  }
</script>


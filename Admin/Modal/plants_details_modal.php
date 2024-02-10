<div class="modal fade" id="addplantsdetails">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Add Plant Details
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="plantForm" class="row g-6s" method="POST" action="code.php" enctype="multipart/form-data">

                    <div class="col-md-12 mt-1">
                        <label for="plant_name">Plant Name<span style="color: red;"> *</span></label>
                        <input type="text" name="plant_name" id="plant_name" class="form-control"  placeholder="lettuce" required>
                    </div>

                    <div class="col-md-12 mt-3"> <!-- Adjusted margin -->
                        <label for="pHLevel">pH Level High<span style="color: red;"> *</span></label>
                        <input type="number" step="0.1" name="ph_lvl_high" class="form-control" id="ph_lvl_high"
                            placeholder="high pH lvl" required>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="pHLevel">pH Level low<span style="color: red;"> *</span></label>
                        <input type="number" step="0.1" name="ph_lvl_low" class="form-control" id="ph_lvl_low"
                            placeholder="low pH lvl" required>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="days_harvest">Days of Harvest<span style="color: red;"> *</span></label>
                        <input type="number" name="days_harvest" id="days_harvest" class="form-control"  placeholder="20" required>
                    </div>

            </div>
            <div class="modal-footer justify-content-between mt-3">
                <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>

                <button type="submit" class="btn btn-primary" name="add-plant-details-btn">
                    <i class="fa fa-save"></i> Save
                </button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<!-- Edit Modal -->
<div class="modal fade" id="editplant">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Plant Details</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="code.php">
          <input type="hidden" class="plantid" name="id">
          <div class="form-group">
            <label for="edit_plant" class="col-sm-6s control-label">Plant Name</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="plant_name" name="plant_name">
            </div>
            </div>
            <!-- Additional fields for displaying Firebase data -->
            <div class="form-group">
              <label for="ph_lvl_high" class="col-sm-6s control-label">pH Level High</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="ph_lvl_high" name="ph_lvl_high">
              </div>
            </div>
            <div class="form-group">
              <label for="ph_lvl_low" class="col-sm-6s control-label">pH Level Low</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="ph_lvl_low" name="ph_lvl_low">
              </div>
            </div>
            <div class="form-group">
              <label for="days_harvest" class="col-sm-6s control-label">Days Harvest</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="days_harvest" name="days_harvest">
              </div>
            </div>
          </div>
      <div class="modal-footer justify-content-between mt-3">

        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">
        <i class="fa fa-close"></i> Close</button>

       <button type="submit" class="btn btn-primary" name="edit-plant-details-btn">
        <i class="fa fa-save"></i> Update</button>

        </form>
      </div>
    </div>
  </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="deleteplant">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Delete....</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="code.php">
          <input type="hidden" class="plantid" name="id">
          <div class="text-center">
            <p>DELETE PLANT</p>
            <h2 class="bold delete_plant" id="delete_plant_name" name="plant_name"></h2>
          </div>
      </div>
      <div class="modal-footer justify-content-between mt-3">

                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>

                <button type="submit" class="btn btn-danger" name="delete-plant-btn">
                  <i class="fa fa-trash"></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

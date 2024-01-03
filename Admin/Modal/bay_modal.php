<div class="modal fade" id="addbay">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add BAY</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="plantForm" class="row g-3" method="POST" action="code.php" enctype="multipart/form-data">

            <div class="col-md-12">
                <label for="bay" class="form-label">BAY<span style="color: red;"> *</span></label>
                <input type="text" name="bay" id="bay" class="form-control" required>
            </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success" name="add-bay-btn">
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
<div class="modal fade" id="editbay">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
              <h4 class="modal-title">Edit BAY</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="code.php">
          <input type="hidden" class="bayid" name="id">
          <div class="form-group">
            <label for="edit_bay" class="col-sm-3 control-label">BAY</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="edit_bay" name="bay">
            </div>
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-flat" name="edit-bay-btn"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deletebay">
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
          <input type="hidden" class="bayid" name="id">
          <div class="text-center">
            <p>DELETE BAY</p>
            <h2 class="bold delete_bay" id="delete_bay_name" name="bay"></h2>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete-bay-btn"><i class="fa fa-trash"></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


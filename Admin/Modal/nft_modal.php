<div class="modal fade" id="addnft">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">ADD NFT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="plantForm" class="row g-3" method="POST" action="code.php">

            <div class="col-md-12">
                <label for="nft" class="form-label">NFT<span style="color: red;"> *</span></label>
                <input type="text" name="nft" id="nft" class="form-control" required>
            </div>

            </div>
            <div class="modal-footer justify-content-between mt-3">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="add-nft-btn">
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
      </div>


<!-- Edit Modal -->
<div class="modal fade" id="editnft">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit NFT</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="code.php">
          <input type="hidden" class="nftid" name="id">
          <div class="form-group">
            <label for="edit_nft" class="col-sm-3 control-label">NFT</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="edit_nft" name="nft">
            </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="edit-nft-btn"><i class="fa fa-save"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deletenft">
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
          <input type="hidden" class="nftid" name="id">
          <div class="text-center">
            <p>DELETE NFT</p>
            <h2 class="bold delete_nft" id="delete_nft_name" name="nft"></h2>
          </div>
      </div>
      <div class="modal-footer justify-content-between mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-danger" name="delete-nft-btn"><i class="fa fa-trash"></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

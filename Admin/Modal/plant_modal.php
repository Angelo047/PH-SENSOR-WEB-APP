<!-- Modal -->
<div class="modal fade" id="addplants" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <form id="plantForm" class="row g-3" method="POST" action="code.php" enctype="multipart/form-data">
      <div class="col-md-6">
      <div class="pic">
        <img src="pics/default.png" id="profile-pic" alt="Plant Preview">
      </div>
      <div class="col-md-12">
        <label for="photo" class="form-label">Plants Photo<span style="color: red;"> *</span></label>
        <input type="file" name="plant_photo" accept="image/jpeg, image/png, image/jpg" id="input-file" onchange="displayImagePreview()" required>
      </div>
    </div>
          <div class="col-md-12">
          <label for="selectPlant" class="form-label">Name of Plant<span style="color: red;"> *</span></label>
          <select class="form-control" aria-label="Name of Plant" id="plant_name" name="plant_name">
              <option value="" selected disabled>Select Plant Name</option>
          </select>
      </div>
          <div class="col-md-6">
            <label for="pHLevel" class="form-label">Required pH Level<span style="color: red;"> *</span></label>
            <input type="text" name="ph_lvl_low" class="form-control" id="ph_lvl_low" placeholder="generated by the system" required readonly>
          </div>
          <div class="col-md-6 mt-2">
          <label for="pHLevel" class="form-label"></label>
            <input type="text" name="ph_lvl_high" class="form-control" id="ph_lvl_high" placeholder="generated by the system" required readonly>
          </div>
          <div class="col-md-6">
            <label for="selectBay" class="form-label">Bay<span style="color: red;"> *</span></label>
            <select class="form-control" name="bay" id="selectBay" required>
              <option selected disabled>Select a Bay</option>
              <?php
        foreach ($bayData as $key => $row) {
            echo '<option value="' . $row['bay'] . '">' . $row['bay'] . '</option>';
        }
        ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="selectPipe" class="form-label">NFT<span style="color: red;"> *</span></label>
            <select class="form-control" name="nft" id="selectPipe" required>
              <option selected disabled>Select an NFT</option>
              <?php
        foreach ($nftData as $key => $row) {
            echo '<option value="' . $row['nft'] . '">' . $row['nft'] . '</option>';
        }
        ?>
            </select>
          </div>
          <div class="col-md-12">
            <label for="datePlanted" class="form-label">Date Planted<span style="color: red;"> *</span></label>
            <div class="input-group date" data-target-input="nearest">
                <input type="date" class="form-control" id="date_planted" name="date_planted"
                      placeholder="Date Planted" data-target="#datePlanted" required
                      min="<?= date('Y-m-d'); ?>" />
            </div>
        </div>
          <div class="col-md-12">
            <label for="estimatedHarvestDate" class="form-label">Estimated Harvest Date</label>
            <div class="input-group"  data-target-input="nearest">
              <input type="date" class="form-control" id="date_harvest" name="date_harvest" placeholder="generated by the system"
                 data-target="#estimatedHarvestDate" required readonly/>
            </div>
          </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close
                </button>
                <button type="submit" class="btn btn-success btn-flat" name="add-plant-btn">
                    <i class="fa fa-save"></i> Save
                </button>
                </form>

      </div>
    </div>
  </div>
</div>


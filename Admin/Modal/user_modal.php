
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Add New User</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="code.php">
                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" name="full-name" placeholder="Jhon Doe" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" placeholder="+91" class="form-control" id="phone" pattern="^\d{10}$" title="Please enter a 10-digit phone number" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email Address</label>
                        <input type="email" name="email" placeholder="@gmail.com" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">User Role</label>
                        <select name="role_as" class="form-control" required>
                        <option value="">-Select Role-</option>
                        <option value="admin">Admin</option>
                        <option value="gardener">Gardener</option>
                    </select>
                    </div>
                    <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="********" class="form-control" id="password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="********" class="form-control" id="confirm_password" required>
                    <div id="password_match" class="text-muted">
                        <span id="retypePasswordError" class="text-danger" style="display: none;">Passwords do not match.</span>
                        <span id="retypePasswordSuccess" class="text-success" style="display: none;">Passwords match.</span>
                    </div>
                </div>
                <div id="password_error" class="text-danger"></div>


            </div>
            <div class="modal-footer  justify-content-between mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close
                </button>
                <button type="submit" class="btn btn-primary" name="register-btn">
                    <i class="fa fa-save"></i> Save
                </button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="edituser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User Details</h4>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="userid" name="id">
                    <div class="form-group">
                        <label for="full-name" class="col-sm-6 control-label">Full Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="full-name" name="full-name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-6 control-label">Email Address</label>
                        <div class="col-sm-12">
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-6 control-label">Phone Number</label>
                        <div class="col-sm-12">
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_as" class="col-sm-6 control-label">User Role</label>
                        <div class="col-sm-12">
                            <select id="role_as" name="role_as" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="gardener">Gardener</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-6 control-label">Status</label>
                        <div class="col-sm-12">
                            <select id="status" name="status" class="form-control">
                                <option value="true">Disabled</option>
                                <option value="false">Active</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between mt-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-close"></i> Close
                </button>
                <button type="submit" class="btn btn-primary" name="edit-user-details-btn">
                    <i class="fa fa-save"></i> Update
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteuser">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="deleteUserForm" method="POST" action="code.php">
          <input type="hidden" class="userId" name="id">
            <div class="text-center">
              <p>Are you sure you want to delete the user?</p>
              <h2 class="bold" id="deleteUserName"></h2>
            </div>
        </div>
        <div class="modal-footer justify-content-between mt-3">
        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">
        <i class="fa fa-close"></i> Close</button>

          <button type="submit" class="btn btn-danger" name="delete-user-btn">
            <i class="fa fa-trash"></i> Delete
          </button>
          </form>
        </div>
      </div>
    </div>
  </div>

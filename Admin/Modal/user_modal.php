
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
                        <input type="tel" id="phone" name="phone" placeholder="Enter 10-digit phone number" pattern="^\+?[0-9]{10}$" title="Phone number must be exactly 10 digits and may start with a '+'" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a valid 10-digit phone number. It may start with a '+'.
                        </div>
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


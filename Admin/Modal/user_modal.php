
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
                        <input type="text" name="full-name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email Address</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">User Role</label>
                        <select name="role_as" class="form-control">
                        <option value="">-Select Role-</option>
                        <option value="admin">Admin</option>
                        <option value="gardener">Gardener</option>
                    </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close
                </button>
                <button type="submit" class="btn btn-success btn-flat" name="register-btn">
                    <i class="fa fa-save"></i> Save
                </button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Edit Category</b></h4>
            </div>
            <div class="modal-body">
                <?php
                if (isset($_GET['id'])) {
                    $uid = $_GET['id'];
                    try {
                        $user = $auth->getUser($uid);
                        ?>
                        <form action="code.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $user->uid; ?>">
                            <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="full_name" value="<?= $user->displayName; ?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="email" name="email" value="<?= $user->email; ?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" value="<?= $user->phoneNumber; ?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="role_as">User Role</label>
                                <select name="role_as" class="form-control">
                                    <option value="">-Select Role-</option>
                                    <option value="admin" <?= ($user->customClaims['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="gardener" <?= ($user->customClaims['role'] == 'gardener') ? 'selected' : ''; ?>>Gardener</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <button type="submit" name="update-user-btn" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                        <?php
                    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                        echo $e->getMessage();
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
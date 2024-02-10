
<?php
include('admin_auth.php');
include('includes/header.php');
include('includes/navbar.php');
 ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
    <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card mt-4">
                    <div class="card-header">
                    <?php
						if(isset($_SESSION['error'])){
						echo "
							<div class='alert alert-danger alert-dismissible text-center'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Error! ".$_SESSION['error']."</h4>

							</div>
						";
						unset($_SESSION['error']);
						}
						if(isset($_SESSION['success'])){
						echo "
							<div class='alert alert-success alert-dismissible text-center'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Success! ".$_SESSION['success']."</h4>

							</div>
						";
						unset($_SESSION['success']);
						}
					?>
                        <h4>
                            Edit & Update User
                            <a href="user.php" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                            <input type="text" name="full-name" value="<?= $user->displayName; ?>" class="form-control">
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
                                                <option value="admin">Admin</option>
                                                <option value="gardener">Gardener</option>
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
                    </div>
                </div>
            </div>


        </div>




    </div>
</div>




<?php include('includes/footer.php'); ?>

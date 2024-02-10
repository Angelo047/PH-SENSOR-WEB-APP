<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
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
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_SESSION['verified_user_id']))
                        {
                            $uid = $_SESSION['verified_user_id'];
                            ?>
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="change_pwd_user_id" value="<?=$uid?>">
                                <div class="form-group mb-3">
                                    <label for="">Old Password</label>
                                    <input type="password" name="old_password" required class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">New Password</label>
                                    <input type="password" name="new_password" required class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Re-Type Password</label>
                                    <input type="password" name="retype_password" required class="form-control">
                                </div>
                                <div class="form-group mb-3 mt-5 float-right">
                                    <button type="submit" name="change_password_btn" class="btn btn-success">Change Password</button>
                                </div>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>

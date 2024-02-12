<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>


<?php
if(isset($_SESSION['error'])){
    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '" . $_SESSION['error'] . "',
                confirmButtonText: 'Okay'
            });
        </script>
    ";
    unset($_SESSION['error']);
}

if(isset($_SESSION['success'])){
    echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '" . $_SESSION['success'] . "',
                confirmButtonText: 'Okay'
            });
        </script>
    ";
    unset($_SESSION['success']);
}
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
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
                                    <input type="password" name="new_password" required class="form-control" id="newPassword">
                                    <span id="passwordLengthError" class="text-danger" style="display: none;">Password must be at least 8 characters long.</span>
                                    <span id="passwordNumberError" class="text-danger" style="display: none;">Password must contain at least one number.</span>
                                    <span id="passwordSpecialCharError" class="text-danger" style="display: none;">Password must contain at least one special character.</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Re-Type Password</label>
                                    <input type="password" name="retype_password" required class="form-control" id="retypePassword">
                                    <span id="retypePasswordError" class="text-danger" style="display: none;">Passwords do not match.</span>
                                    <span id="retypePasswordSuccess" class="text-success" style="display: none;">Passwords match.</span>
                                </div>
                                <div class="form-group mb-3 mt-5 float-right">
                                    <button type="submit" name="change_password_btn" class="btn btn-primary">Change Password</button>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#retypePassword').on('keyup', function() {
            var newPassword = $('#newPassword').val();
            var retypePassword = $(this).val();

            if (newPassword !== retypePassword) {
                $('#retypePasswordError').show(); // Show error message
                $('#retypePasswordSuccess').hide(); // Hide success message
            } else {
                $('#retypePasswordError').hide(); // Hide error message
                $('#retypePasswordSuccess').show(); // Show success message
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#newPassword').on('keyup', function() {
            var newPassword = $(this).val();
            var hasNumber = /\d/.test(newPassword); // Regular expression to check for at least one number
            var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(newPassword); // Regular expression to check for at least one special character

            // Check password length
            if (newPassword.length < 8) {
                $('#passwordLengthError').show();
            } else {
                $('#passwordLengthError').hide();
            }

            // Check if password contains at least one number
            if (!hasNumber) {
                $('#passwordNumberError').show();
            } else {
                $('#passwordNumberError').hide();
            }

            // Check if password contains at least one special character
            if (!hasSpecialChar) {
                $('#passwordSpecialCharError').show();
            } else {
                $('#passwordSpecialCharError').hide();
            }
        });
    });
</script>

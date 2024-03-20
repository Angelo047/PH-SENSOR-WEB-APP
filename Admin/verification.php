<?php
include('admin_auth.php'); // Include the file that contains authorization logic
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Password Verification Form -->
                        <form action="code.php" method="post">
                            <div class="form-group">
                                <label for="password">Enter Your Password to Access Profile Settings:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="verify">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>

<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12">
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header">
                        <h4 class="font-weight-bold text-success">Users&nbsp;<a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> New</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Roles</th>
                                        <th class="text-center">Disable / Enable</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                $users = $auth->listUsers();
                                $i = 1;
                                foreach ($users as $user)
                                {
                                    ?>
                                    <a href="#id">
                                    <img src="" alt="">
                                    </a>
                                    <tr class="text-center">
                                        <td><?=$user->uid;?></td>
                                        <td><?=$user->displayName;?></td>
                                        <td><?=$user->phoneNumber;?></td>
                                        <td><?=$user->email;?></td>
                                        <td>
                                            <?php
                                            $claims = $auth->getUser($user -> uid)->customClaims;

                                            if(isset($claims['admin']) == true)
                                            {
                                                echo '<span class="badge bg-warning">Admin</span>';
                                            }
                                            elseif(isset($claims['gardener']) == true)
                                            {
                                                echo '<span class="badge bg-success">Gardener</span>';
                                            }
                                            elseif($claims == null)
                                            {
                                                echo "No Role";
                                            }
                                            ?>
                                        </span>
                                        </td>
                                        <td>
                                            <?php
                                            if($user -> disabled)
                                            {
                                                echo "Disabled";
                                            }
                                            else{
                                                echo "Enabled";
                                            }
                                            ?>
                                        </td>

                                        <td>

                                        <a href="user_edit.php?id=<?=$user -> uid;?>" class="btn btn-primary">Edit </a>
                                        </td>

                                        </td>
                                            <td>
                                        <form action="code.php" method="POST">
                                            <button type="submit" name="reg-user-delete-btn" value="<?=$user -> uid;?>" class="btn btn-danger">Delete</button>
                                        </form>
                                        </td>


                                    </tr>

                                    <?php

                                }
                        ?>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                      </div>
                                </div>



<?php
include('Modal/user_modal.php');
include('includes/footer.php');
?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Passwords do not match");
        } else {
            confirm_password.setCustomValidity("");
        }
    }

    password.addEventListener("change", validatePassword);
    confirm_password.addEventListener("keyup", validatePassword);
});
</script>

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
                        <h4 class="font-weight-bold text-primary"> &nbsp;<a href="#addnew" data-toggle="modal" class="btn btn-primary"> <i class="fas fa-circle-plus fa-lg"></i>&nbsp; Add Users</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
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

                                        <a href="user_edit.php?id=<?=$user -> uid;?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit </a>
                                        </td>

                                        </td>
                                            <td>
                                            <form id="deleteForm" action="code.php" method="POST">
                                                    <input type="hidden" name="reg-user-delete-btn" id="userIdToDelete">
                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('<?=$user->uid;?>')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
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

<script>
    function confirmDelete(userId) {
        // Set the userId to be deleted in a hidden input field
        document.getElementById('userIdToDelete').value = userId;

        // Display SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicks "Yes," submit the form
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>
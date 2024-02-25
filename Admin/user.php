<?php
include('admin_auth.php');

// Redirect unauthorized users to another page
$uid = $verifiedIdToken->claims()->get('sub');
$claims = $auth->getUser($uid)->customClaims;
if(isset($claims['admin']) == false)  {
    header('Location: index.php');
    exit();
}

include('includes/header.php');
include('includes/navbar.php');
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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
<<<<<<< HEAD
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Roles</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = $auth->listUsers();
                            $i = 1;
                            foreach ($users as $user) {
                            ?>
                                <tr class="text-center">
                                    <td><?= $user->displayName; ?></td>
                                    <td><?= $user->phoneNumber; ?></td>
                                    <td><?= $user->email; ?></td>
                                    <td>
                                        <?php
                                        $claims = $auth->getUser($user->uid)->customClaims;

                                        if (isset($claims['admin']) == true) {
                                            echo '<span class="badge bg-warning">Admin</span>';
                                        } elseif (isset($claims['gardener']) == true) {
                                            echo '<span class="badge bg-success">Gardener</span>';
                                        } elseif ($claims == null) {
                                            echo "No Role";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($user->disabled) {
                                            echo '<span class="badge bg-danger">Disabled</span>';
                                        } else {
                                            echo '<span class="badge bg-success">Active</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary edit-user" data-id="<?= $user->uid ?>"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-danger delete-user" data-id="<?= $user->uid ?>"><i class="fas fa-trash"></i> Delete</a>
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
=======
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
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7



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


<script>
    // Password validation function
    function validatePassword(password) {
        var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return pattern.test(password);
    }

    // Function to check if password and confirm password match
    function passwordsMatch(password, confirm_password) {
        return password === confirm_password;
    }

    // Function to handle password validation
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        var password_error = document.getElementById("password_error");
        var retypePasswordError = document.getElementById("retypePasswordError");
        var retypePasswordSuccess = document.getElementById("retypePasswordSuccess");

        // Validate password
        if (!validatePassword(password)) {
            password_error.innerHTML = "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.";
            return false;
        }

        // Check if password and confirm password match
        if (!passwordsMatch(password, confirm_password)) {
            retypePasswordError.style.display = "block";
            retypePasswordSuccess.style.display = "none";
            return false;
        } else {
            retypePasswordError.style.display = "none";
            retypePasswordSuccess.style.display = "block";
        }

        // If validation passed, clear error message
        password_error.innerHTML = "";
        return true;
    }

    // Add event listener to form submission
    document.getElementById("myForm").addEventListener("submit", function(event) {
        // Prevent form submission if validation fails
        if (!validateForm()) {
            event.preventDefault();
        }
    });
</script>


<<<<<<< HEAD
<script>
$(document).ready(function() {
    // Handle Delete button click
    $('.delete-user').click(function() {
        var userId = $(this).data('id');
        var userName = $(this).closest('tr').find('td:eq(0)').text(); // Assuming display name is in the second column

        // Populate the modal with user data
        $('#deleteuser').find('.userId').val(userId);
        $('#deleteUserName').text(userName);

        // Show the modal
        $('#deleteuser').modal('show');
    });

    // Handle form submission for user deletion
    $('#deleteUserForm').submit(function(event) {
        event.preventDefault();
        var userId = $('.userId').val();

        // Prompt confirmation using SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete the user.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc4c64',
            cancelButtonColor: '#3b71ca',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                 // Add loading animation
                 Swal.fire({
                        title: 'Deleting...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading();
                        }
                    });
                // If confirmed, call function to delete the user
                deleteUser(userId);
            }
        });
    });

    // Function to delete user
    function deleteUser(userId) {
        // Perform AJAX request to delete the user
        $.ajax({
            url: 'code.php', // Change this to the actual endpoint for deleting users
            type: 'POST',
            data: { userId: userId },
            success: function(response) {
                // Redirect to user.php after deletion
                window.location.href = "user.php";
            },
            error: function(xhr, status, error) {
                // Show error message
                console.error('Error deleting user:', status, error);
            }
        });
    }
});
</script>

<script>
    $(document).ready(function() {
        // Initialize the modal
        $('#edituser').modal();

        $('.edit-user').click(function() {
            // Get the User ID from the button data attribute
            var userId = $(this).data('id');

            // Populate the modal with user data
            $('#edituser').find('.userId').val(userId);

            // Use AJAX to fetch the data from Firebase using the User ID
            $.ajax({
                url: 'user_details_row.php',
                type: 'POST',
                data: { id: userId },
                success: function(data) {
                    // Parse the data (assuming it's in JSON format)
                    var userData = JSON.parse(data);

                    // Populate the modal with the retrieved data
                    $('#edituser').find('.userid').val(userId);
                    $('#edituser').find('input[name="full-name"]').val(userData.displayName);
                    $('#edituser').find('input[name="email"]').val(userData.email);
                    $('#edituser').find('input[name="phone"]').val(userData.phoneNumber);
                    $('#edituser').find('select[name="role_as"]').val(userData.claims.admin ? 'admin' : 'gardener');
                    $('#edituser').find('select[name="status"]').val(userData.disabled ? 'true' : 'false');


                    // Show the modal
                    $('#edituser').modal('show');
                },
                error: function(error) {
                    console.log('Error fetching data: ', error);
                }
            });
        });

        // Handle form submission for user details update
        $('#editUserForm').submit(function(event) {
            event.preventDefault();
            var userId = $('.userId').val();
            // Serialize the form data
            var formData = $(this).serialize() + '&edit-user-details-btn=1'; // Add edit-user-details-btn to the serialized data

            // Prompt confirmation using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to Edit the User.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b71ca',
                cancelButtonColor: '#dc4c64',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add loading animation
                    Swal.fire({
                        title: 'Updating...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // If confirmed, call function to update the user
                    updateUser(userId, formData);
                }
            });
        });

        function updateUser(userId, formData) {
            // Submit the form via AJAX
            $.ajax({
                url: 'code.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    // Refresh the page or update the table with the updated data
                    location.reload(); // Reload the page for demonstration
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error updating user details:', status, error);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize the data table
        var table = $('#myTable').DataTable();

        // Event handler for editing user
        $('#myTable').on('click', '.edit-user', function() {
            var userId = $(this).data('id');
            // Populate modal and show it
            // Example: $('#edituser').modal('show');
        });

        // Event handler for deleting user
        $('#myTable').on('click', '.delete-user', function() {
            var userId = $(this).data('id');
            // Perform delete operation or show confirmation modal
        });
    });
</script>
=======


>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7

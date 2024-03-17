<?php
include('dbcon.php'); // Include your database connection file
include('admin_auth.php'); // Include the file that contains authorization logic
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="content-wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mt-5">
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

                <div class="card-header">
                    My Profile
                </div>
                <div class="card-body">

                <?php

                if(isset($_SESSION['verified_user_id']))
                {
                    $uid = $_SESSION['verified_user_id'];
                    $user = $auth->getUser($uid);
                    ?>

                <form action="code.php" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-8 boarder-end">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="display_name" value="<?=$user->displayName;?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" value="<?=$user->phoneNumber;?>" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <div class="form-control">
                               <?=$user->email;?>
                                </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label for="">Role</label>
                                <div class="form-control">
                                <?php
                                            $claims = $auth->getUser($user -> uid)->customClaims;

                                            if(isset($claims['admin']) == true)
                                            {
                                                echo "Admin";
                                            }
                                            elseif(isset($claims['gardener']) == true)
                                            {
                                                echo "Gardener";
                                            }
                                            elseif($claims == null)
                                            {
                                                echo "No Role";
                                            }
                                            ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label for="">Account Status</label>
                                <div class="form-control">
                                <?php
                                            if($user -> disabled)
                                                {
                                                echo "Disabled";
                                            }
                                            else{
                                                echo "Active";
                                            }
                                            ?>
                                </div>
                                </div>
                            </div>
                            </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group border mb-3">
                                <?php
                                if($user->photoUrl != NULL)
                                {
                                    ?>

                                    <img src="<?=$user->photoUrl?>" class="w-100" alt="user-profile">

                                    <?php
                                }
                                else{
                                    echo "Update Your Profile Picture";
                                }
                                ?>
                            </div>
                            <div class="form-group border mb-3">
                            <label for="">Upload Profile Image</label>
                            <input type="file" name="profile" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="form-group float-right">
                                <button type="submit" name="update_user_profile" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </div>
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

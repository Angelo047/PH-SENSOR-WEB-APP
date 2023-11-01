<?php
session_start();
include('dbcon.php');

//REGISTER FUNCTION FOR USER

if (isset($_POST['register-btn'])) {
    $full_name = $_POST['full-name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $selectedRole = $_POST['role_as']; // Get the selected role from the form

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'phoneNumber' => '+91' . $phone,
        'password' => $password,
        'displayName' => $full_name,
    ];

    $createdUser = $auth->createUser($userProperties);

    if ($createdUser) {
        // Set custom user claims based on the selected role
        if ($selectedRole === 'admin') {
            $claims = ['admin' => true];
        } elseif ($selectedRole === 'gardener') {
            $claims = ['gardener' => true];
        } else {
            $claims = [];
        }

        // Set the custom claims
        $auth->setCustomUserClaims($createdUser->uid, $claims);

        $_SESSION['status'] = "User Created Successfully";
        header('Location: user.php');
    } else {
        $_SESSION['status'] = "User Failed to Create";
        header('Location: user.php');
    }
}

//UPDATE FUNCTION FOR USER

if (isset($_POST['update-user-btn'])) {
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $uid = $_POST['user_id'];
    $selectedRole = $_POST['role_as'];

    $properties = [
        'displayName' => $full_name,
        'email' => $email,
        'phoneNumber' => $phone,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if ($updatedUser) {
        // Set custom claims based on the selected role
        $claims = [];

        if ($selectedRole === 'admin') {
            $claims['admin'] = true;
        } elseif ($selectedRole === 'gardener') {
            $claims['gardener'] = true;
        } else {
            // Handle other roles or invalid selections here
        }

        // Set the custom claims
        $auth->setCustomUserClaims($uid, $claims);

        $_SESSION['status'] = "User Updated Successfully";
        header("Location: user.php");
        exit();
    } else {
        $_SESSION['status'] = "User Failed to Update";
        header("Location: user.php");
        exit();
    }
}



//USER DELETE FUNCTION
if(isset($_POST['reg-user-delete-btn']))
{
    $uid = $_POST['reg-user-delete-btn'];

    try{
    $auth->deleteUser($uid);
    $_SESSION['status'] = "User Deleted Successfully";
    header('Location: user.php');
    exit();
    }
    catch(Exception $e)
    {
        $_SESSION['status'] = "User Failed to Delete";
        header('Location: user.php');
        exit();
    }
}

//USER STATUS UPDATE
if(isset($_POST['enable_disable_acc_btn']))
{
    $disable_enable = $_POST['select_enable_disable'];
    $uid = $_POST['enable_disable_id'];


    if($disable_enable == "disable")
    {
        $updatedUser = $auth->disableUser($uid);
        $msg = "Account Disabled";
    }
    else{
        $updatedUser = $auth->enableUser($uid);
        $msg = "Account Enabled";
    }

    if($updatedUser)
    {
        $_SESSION['status'] = $msg;
        header('Location: user-list.php');
        exit();
    }else{
        $_SESSION['status'] = "Something Went Wrong.";
        header('Location: user-list.php');
        exit();
    }
}

//UPDATE USER PROFILE

if(isset($_POST['update_user_profile']))
{

    $display_name = $_POST['display_name'];
    $phone = $_POST['phone'];
    $profile = $_FILES['profile']['name'];
    $random_no = rand(1111,9999);

    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);

    $new_image = $random_no.$profile;
    $old_image = $user->photoUrl;

    if($profile != NULL)
    {
        $file_name = 'uploads/'.$new_image;
    }
    else
    {
        $file_name = $old_image;
    }

    $properties = [
        'displayName' => $display_name,
        'phoneNumber' => $phone,
        'photoUrl' => $file_name,

    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if($updatedUser)
    {

    if($profile != NULL)
        {
            move_uploaded_file($_FILES['profile']['tmp_name'], "uploads/".$new_image);
            $file_name = 'uploads/'.$old_image;
            if($old_image != NULL)
            {
                unlink($old_image);
            }
        }
        $_SESSION['status'] = "User Profile Updated Successfully";
        header('Location: my-profile.php');
        exit(0);

    }
    else
    {
        $_SESSION['status'] = "User Profile Failed to Updated";
        header('Location: my-profile.php');
        exit(0);

    }

}



?>
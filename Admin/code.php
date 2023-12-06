<?php
session_start();
include('dbcon.php');


// CREATE FUNCTION FOR PLANTS
if (isset($_POST['add-plant-btn'])) {
    $file_tmp = $_FILES['plant_photo']['tmp_name'];
    $file_name = $_FILES['plant_photo']['name'];
    $file_destination = "pics/" . $file_name;

    if (move_uploaded_file($file_tmp, $file_destination)) {
            // File uploaded successfully, update $postData
        $postData = [
            'plant_photo' => $file_destination,
            'plant_name' => $_POST['plant_name'],
            'ph_lvl_low' => $_POST['ph_lvl_low'],
            'ph_lvl_high' => $_POST['ph_lvl_high'],
            'bay' => $_POST['bay'],
            'nft' => $_POST['nft'],
            'date_planted' => $_POST['date_planted'],
            'date_harvest' => $_POST['date_harvest'],
            'plant_status' => 'Planted', // New plant status
        ];

        $ref_table = "plants";
        $postRef_result = $database->getReference($ref_table)->push($postData);

        if ($postRef_result->getKey() !== null) {
            $_SESSION['success'] = "Plant added successfully";
            header('Location: plants.php');
            exit(); // Make sure to exit after redirect
        } else {
            $_SESSION['error'] = "Failed to add plant";
        }
    } else {
        // Failed to upload file
        $_SESSION['error'] = "Failed to upload plant photo";
    }

    header('Location: plants.php');
    exit(); // Make sure to exit after redirect
}




//REGISTER FUNCTION FOR USER

if (isset($_POST['register-btn'])) {
    $full_name = $_POST['full-name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $selectedRole = $_POST['role_as']; // Get the selected role from the form

    // Check if the password and confirm password match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password and Confirm Password do not match";
        header('Location: user.php');
        exit;
    }

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

        $_SESSION['success'] = "User Created Successfully";
        header('Location: user.php');
    } else {
        $_SESSION['error'] = "User Failed to Create";
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

        $_SESSION['success'] = "User Updated Successfully";
        header("Location: user.php");
        exit();
    } else {
        $_SESSION['error'] = "User Failed to Update";
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
    $_SESSION['success'] = "User Deleted Successfully";
    header('Location: user.php');
    exit();
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = "User Failed to Delete";
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
        $_SESSION['success'] = $msg;
        header('Location: user-list.php');
        exit();
    }else{
        $_SESSION['error'] = "Something Went Wrong.";
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
        $_SESSION['success'] = "User Profile Updated Successfully";
        header('Location: my-profile.php');
        exit(0);

    }
    else
    {
        $_SESSION['error'] = "User Profile Failed to Updated";
        header('Location: my-profile.php');
        exit(0);

    }

}

//CHANGE PASSWORD OF USER
if(isset($_POST['change_password_btn']))
{
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];
    $uid = $_POST['change_pwd_user_id'];

    if($new_password == $retype_password)
    {

    $updatedUser = $auth->changeUserPassword($uid, $new_password);

    if($updatedUser)
    {
        $_SESSION['success'] = "Password Updated Successfully";
        header('Location: change-password.php');
        exit();
    }else{
        $_SESSION['error'] = "Password Failed to Update";
        header('Location: change-password.php');
        exit();
    }

    }
    else{
        $_SESSION['error'] = "New Password and Re-Type Password does not match";
        header("Location: change-password.php?id=$uid");
        exit();
    }
}



?>
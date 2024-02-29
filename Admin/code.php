<?php
session_start();
include('dbcon');

// Check if the form is submitted for updating user details
if(isset($_POST['edit-user-details-btn'])) {
    $userId = $_POST['id'];
    $fullName = $_POST['full-name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone'];
    $roleAs = $_POST['role_as']; // Assuming 'role_as' corresponds to custom claims
    $status = isset($_POST['status']) ? filter_var($_POST['status'], FILTER_VALIDATE_BOOLEAN) : null; // Convert string to boolean

    try {
        // Get the user data
        $user = $auth->getUser($userId);

        // Update the user's display name, email, and phone number
        $userProperties = [
            'displayName' => $fullName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
        ];

        if ($status !== null) {
            $userProperties['disabled'] = $status;
        }

if(isset($_POST['id']) && isset($_POST['plant_status'])) {
    $id = $_POST['id'];
    $plant_status = $_POST['plant_status'];

    // Get the current date
    $claim_date = date('Y-m-d');

    // Assuming $database is your Firebase instance
    $plantRef = $database->getReference('plants/' . $id);

    // Update the plant status and claim_date
    $plantRef->update([
        'plant_status' => $plant_status,
        'claim_date' => $claim_date,
    ]);

    // Redirect with success message
    $_SESSION['success'] = "Plant status updated successfully!";
    header('Location: plants'); // Replace with the correct page URL
    exit();
}

        // Update the user
        $updatedUser = $auth->updateUser($userId, $userProperties);

        // Update custom claims (user role)
        $claimsToUpdate = [];
        if ($roleAs === 'admin') {
            $claimsToUpdate['admin'] = true;
        } elseif ($roleAs === 'gardener') {
            $claimsToUpdate['gardener'] = true;
        }

        // Set custom claims for the user
        $auth->setCustomUserClaims($userId, $claimsToUpdate);

        $_SESSION['success'] = "User Updated Successfully";
        echo json_encode(['success' => true]); // Send success response
        exit();
    } catch (\Throwable $e) {
        $_SESSION['error'] = "User Failed to Update";
        echo json_encode(['error' => $e->getMessage()]); // Send error response
        exit();
    }
}


if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    try {
        $auth->deleteUser($userId);
        $_SESSION['success'] = "User Deleted Successfully";
        echo json_encode(['success' => true]); // Send success response
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = "User Failed to Delete";
        echo json_encode(['error' => 'User deletion failed']); // Send error response
        exit();
    }
}


if(isset($_POST['id']) && isset($_POST['plant_status'])) {
    $id = $_POST['id'];
    $plant_status = $_POST['plant_status'];

    // Get the current date
    $claim_date = date('Y-m-d');

    // Assuming $database is your Firebase instance
    $plantRef = $database->getReference('plants/' . $id);

    // Update the plant status and claim_date
    $plantRef->update([
        'plant_status' => $plant_status,
        'claim_date' => $claim_date,
    ]);

    // Redirect with success message
    $_SESSION['success'] = "Plant status updated successfully!";
    header('Location: plants'); // Replace with the correct page URL
    exit();
}


if (isset($_POST['edit-plant-details-btn'])) {
    $plantId = $_POST['id'];
    $plant_name = $_POST['plant_name'];
    $ph_lvl_high = $_POST['ph_lvl_high'];
    $ph_lvl_low = $_POST['ph_lvl_low'];
    $days_harvest = $_POST['days_harvest'];

    $plantRef = $database->getReference('plants_details/' . $plantId);

    $plantRef->update([
        'plant_name' => $plant_name,
        'ph_lvl_high' => $ph_lvl_high,
        'ph_lvl_low' => $ph_lvl_low,
        'days_harvest' => $days_harvest,
    ]);

    $_SESSION['success'] = "Plant Details Updated successfully";
    header('Location: plants_details');
    exit;
}



if (isset($_POST['delete-plant-btn'])) {
    $plantId = $_POST['id'];

    $plantRef = $database->getReference('plants_details/' . $plantId);

    $plantRef->remove();

    $_SESSION['success'] = "Plant Details Deleted successfully";
    header('Location: plants_details');
      exit;
}





if (isset($_POST['delete-bay-btn'])) {
    $bayId = $_POST['id'];

    $bayRef = $database->getReference('BAY/' . $bayId);

    $bayRef->remove();

    $_SESSION['success'] = "BAY Deleted successfully";
    header('Location: bay_nft');
      exit;
}



if (isset($_POST['edit-bay-btn'])) {
    $bayId = $_POST['id'];
    $newBAYValue = $_POST['bay'];

    $bayRef = $database->getReference('BAY/' . $bayId);

    $bayRef->update([
        'bay' => $newBAYValue,
    ]);

    $_SESSION['success'] = "BAY Updated successfully";
        header('Location: bay_nft');
    exit;
}


    if (isset($_POST['delete-nft-btn'])) {
        $nftId = $_POST['id'];

        $nftRef = $database->getReference('NFT/' . $nftId);

        $nftRef->remove();

        $_SESSION['success'] = "NFT Deleted successfully";
        header('Location: bay_nft');
          exit;
    }


if (isset($_POST['edit-nft-btn'])) {
    // Get the NFT ID and new value from the form
    $nftId = $_POST['id'];
    $newNFTValue = $_POST['nft'];

    // Reference to the NFT in the Realtime Database
    $nftRef = $database->getReference('NFT/' . $nftId);

    // Update the NFT value
    $nftRef->update([
        'nft' => $newNFTValue,
    ]);

    // Redirect or perform any other actions after the update
    $_SESSION['success'] = "NFT Updated successfully";
        header('Location: bay_nft');
    exit;
}


if (isset($_POST['add-nft-btn'])) {
    $postData = [
        'nft' => $_POST['nft'],
    ];

    $ref_table = "NFT";
    $postRef_result = $database->getReference($ref_table)->push($postData);

    if ($postRef_result->getKey()) {
        $_SESSION['success'] = "NFT added successfully";
        header('Location: bay_nft');
    } else {
        $_SESSION['error'] = "Failed to add plant";
    }
}

if (isset($_POST['add-bay-btn'])) {
    $postData = [
        'bay' => $_POST['bay'],
    ];

    $ref_table = "BAY";
    $postRef_result = $database->getReference($ref_table)->push($postData);

    if ($postRef_result->getKey()) {
        $_SESSION['success'] = "BAY added successfully";
        header('Location: bay_nft');
    } else {
        $_SESSION['error'] = "Failed to add plant";
    }
}


// CREATE DETAILS FOR PLANTS
if (isset($_POST['add-plant-details-btn'])) {
    $postData = [
        'plant_name' => $_POST['plant_name'],
        'ph_lvl_low' => $_POST['ph_lvl_low'],
        'ph_lvl_high' => $_POST['ph_lvl_high'],
        'days_harvest' => $_POST['days_harvest'],
    ];

    $ref_table = "plants_details";
    $postRef_result = $database->getReference($ref_table)->push($postData);

    if ($postRef_result->getKey()) {
        $_SESSION['success'] = "Plant Details added successfully";
        header('Location: plants_details');
    } else {
        $_SESSION['error'] = "Failed to add plant";
    }
}



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
            header('Location: plants');
            exit(); // Make sure to exit after redirect
        } else {
            $_SESSION['error'] = "Failed to add plant";
        }
    } else {
        // Failed to upload file
        $_SESSION['error'] = "Failed to upload plant photo";
    }

    header('Location: plants');
    exit(); // Make sure to exit after redirect
}



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
        header('Location: user');
        exit;
    }

    try {
        // Validate existing email
        $existingUser = $auth->getUserByEmail($email);
        if ($existingUser) {
            $_SESSION['error'] = "Email already exists";
            header('Location: user');
            exit;
        }
    } catch (Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        // User not found, continue with registration
    }

    try {
        // Validate existing phone number
        $existingUserByPhone = $auth->getUserByPhoneNumber('+91' . $phone);
        if ($existingUserByPhone) {
            $_SESSION['error'] = "Phone number already exists";
            header('Location: user');
            exit;
        }
    } catch (Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        // User not found, continue with registration
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
        header('Location: user');
    } else {
        $_SESSION['error'] = "User Failed to Create";
        header('Location: user');
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
        header("Location: user");
        exit();
    } else {
        $_SESSION['error'] = "User Failed to Update";
        header("Location: user");
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
        header('Location: user-list');
        exit();
    }else{
        $_SESSION['error'] = "Something Went Wrong.";
        header('Location: user-list');
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
        header('Location: my-profile');
        exit(0);

    }
    else
    {
        $_SESSION['error'] = "User Profile Failed to Updated";
        header('Location: my-profile');
        exit(0);

    }

}

//CHANGE PASSWORD OF USER
if(isset($_POST['change_password_btn']))
{
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];
    $uid = $_POST['change_pwd_user_id'];

    // Authenticate the user with the old password
    try {
        $user = $auth->getUser($uid); // Get the user information

        $signInResult = $auth->signInWithEmailAndPassword($user->email, $old_password);

        // Old password is correct, proceed with changing the password
        if($new_password == $retype_password)
        {
            $updatedUser = $auth->changeUserPassword($uid, $new_password);
            if($updatedUser)
            {
                $_SESSION['success'] = "Password Updated Successfully";
                header('Location: change-password');
                exit();
            } else {
                $_SESSION['error'] = "Password Failed to Update";
                header('Location: change-password');
                exit();
            }
        } else {
            $_SESSION['error'] = "New Password and Re-Type Password do not match";
            header("Location: change-password");
            exit();
        }
    } catch (Exception $e) {
        // Old password is incorrect
        $_SESSION['error'] = "Old Password is incorrect";
        header("Location: change-password");
        exit();
    }
}



?>
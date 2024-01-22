<?php
if (isset($_SESSION['verified_user_id'])) {
    if (isset($_SESSION['verified_admin'])) {
        $uid = $_SESSION['verified_user_id'];
        $idTokenString = $_SESSION['idTokenString'];

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $claims = $auth->getUser($uid)->customClaims;

            if (isset($claims['admin']) && $claims['admin'] === true) {
                // The user is verified and is an admin, continue with the admin-specific code here
            } else {
                // The user is not an admin, redirect to logout
                header('Location: logout.php');
                exit(0);
            }

        } catch (FailedToVerifyToken $e) {
            // Token verification failed, redirect to logout
            $_SESSION['expiry_status'] = "Token Expired/Invalid, Login Again";
            header('Location: logout.php');
            exit();
        }

    } else {
        // The user is not verified as an admin, redirect to the referring page
        $_SESSION['status'] = "Access Denied, You are not Admin";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit();
    }

} else {
    // User not authenticated, redirect to login
    $_SESSION['status'] = "Login to Access this page";
    header('Location: login.php');
    exit();
}
?>

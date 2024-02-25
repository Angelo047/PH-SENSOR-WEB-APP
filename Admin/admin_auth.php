<?php
session_start();
include('dbcon.php');
<<<<<<< HEAD

use Firebase\Auth\Token\Exception\ExpiredToken;

if (isset($_SESSION['verified_user_id']) && isset($_SESSION['verified_admin'])) {
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        $claims = $auth->getUser($uid)->customClaims;

=======
?>

<?php
if (isset($_SESSION['verified_user_id']) && isset($_SESSION['verified_admin'])) {
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        $claims = $auth->getUser($uid)->customClaims;

>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
        if (isset($claims['admin']) || isset($claims['gardener'])) {
            // The user is verified and is an admin or gardener, continue with the admin-specific code here
        } else {
            // The user is not an admin or gardener, redirect to logout
            header('Location: ../logout.php');
            exit();
        }

<<<<<<< HEAD
    } catch (ExpiredToken $e) {
        // Token expired, redirect to logout
        // $_SESSION['expiry_status'] = "Token Expired/Invalid, Login Again";
=======
    } catch (FailedToVerifyToken $e) {
        // Token verification failed, redirect to logout
        $_SESSION['expiry_status'] = "Token Expired/Invalid, Login Again";
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
        header('Location: ../logout.php');
        exit();
    }

} else {
    // User not authenticated as an admin or gardener, redirect to login
    $_SESSION['status'] = "Access Denied, You are not Admin or Gardener";
    header('Location: ../logout.php');
    exit();
}
?>

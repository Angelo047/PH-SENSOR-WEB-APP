<?php
session_start();
include('dbcon.php');

<<<<<<< HEAD
use Firebase\Auth\Token\Exception\ExpiredToken;

=======
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
if(isset($_SESSION['verified_user_id']))
{
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
    } catch (FailedToVerifyToken $e) {
        // echo 'The token is invalid: '.$e->getMessage();
<<<<<<< HEAD
        // $_SESSION['expiry_status'] = "Token Expired/Invalid, Login Again";
=======
        $_SESSION['expiry_status'] = "Token Expired/Invalid, Login Again";
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
        header('Location: ../logout.php');
        exit();
    }


}else{
    $_SESSION['status'] = "Login to Access this page";
    header('Location: ../logout.php');
    exit();
}

?>
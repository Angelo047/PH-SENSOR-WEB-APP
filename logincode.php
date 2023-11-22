<?php
session_start();
include('dbcon.php');

if(isset($_POST['login-btn']))
{

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = $auth->getUserByEmail("$email");

        try{
        $signInResult = $auth->signInWithEmailAndPassword($email, $password);
        $idTokenString =  $signInResult -> idToken();

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->claims()->get('sub');

            $claims = $auth->getUser($uid)->customClaims;

            if(isset($claims['admin']) == true)
            {
                $_SESSION['verified_admin'] = true;
                $_SESSION['verified_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;
            }
            elseif(isset($claims['gardener']) == true)
            {
                $_SESSION['verified_gardener'] = true;
                $_SESSION['verified_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;
            }
            elseif($claims == null)
            {
                $_SESSION['verified_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;
            }
            // $_SESSION['success'] = "Welcome To Homepage";
            header('Location: Admin\index.php');
            exit();

        } catch (FailedToVerifyToken $e) {
            echo 'The token is invalid: '.$e->getMessage();
        }


        }catch(Exception $e){
            $_SESSION['error'] = "Wrong Password";
            header('Location: login.php');
            exit();;
        }

    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        $_SESSION['error'] = "Wrong Email";
        header('Location: login.php');
        exit();;
    }
}else{
    $_SESSION['error'] = "Not Allowed";
    header('Location: login.php');
    exit();
}








?>
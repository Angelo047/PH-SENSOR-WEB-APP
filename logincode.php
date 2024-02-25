<?php
session_start();
include('dbcon.php');

if(isset($_POST['login-btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = $auth->getUserByEmail("$email");

        $signInResult = $auth->signInWithEmailAndPassword($email, $password);
        $idTokenString = $signInResult->idToken();

        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        $uid = $verifiedIdToken->claims()->get('sub');

        $claims = $auth->getUser($uid)->customClaims;

        if(isset($claims['admin']) == true || isset($claims['gardener']) == true)  {
            $_SESSION['verified_admin'] = true;
            $_SESSION['verified_user_id'] = $uid;
            $_SESSION['idTokenString'] = $idTokenString;
        }
<<<<<<< HEAD
        header('Location: Admin/');
=======
        header('Location: Admin/index.php');
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
        exit();

    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        $_SESSION['error'] = "Wrong Password or Email";
<<<<<<< HEAD
        header('Location: index');
=======
        header('Location: login.php');
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
        exit();
    } catch (FailedToVerifyToken $e) {
        echo 'The token is invalid: '.$e->getMessage();
    } catch(Exception $e) {
        $_SESSION['error'] = "Wrong Password or Email";
<<<<<<< HEAD
        header('Location: index');
        exit();
    }
} else {
    $_SESSION['error'] = "Wrong Password or Email";
    header('Location: index');
=======
        header('Location: login.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Not Allowed";
    header('Location: login.php');
>>>>>>> 2a45103d43e6ae2149c68e6bf8df71ad1eca07f7
    exit();
}
?>

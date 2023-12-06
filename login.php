<?php
session_start();

// If the user is already logged in, redirect to the home page
if (isset($_SESSION['verified_user_id'])) {
    $_SESSION['status'] = "You are already logged in!";
    header('Location: index.php');
    exit();
}

include('includes/header.php');
?>

<?php
    if(isset($_SESSION['error'])){
        echo "
        <div class='alert alert-danger alert-dismissible text-center'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4><i class='icon fa fa-warning'></i> Error! ".$_SESSION['error']."</h4>

        </div>
        ";
    unset($_SESSION['error']);
}
?>


<div class="container">
    <div class="left">
        <div class="overlay">
            <!-- <img src="bg/Ellipse 1.jpg" class="elipse"> -->
            <h1>ROSA L. SUSANO - NOVALICHES ELEMENTARY SCHOOL</h1>
            <span>Water pH Monitoring System</span>
        </div>
    </div>

    <div class="right">
        <img src="bg/v5_1541.png" class="logo" width="20%" height="20%" style="margin-top:40px;">
        <form name="myForm" action="logincode.php" onsubmit="return validateForm()" method="post" class="form">
            <h2 class="mt-3">USER LOGIN</h2>
            <label for="email">Username</label>
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" name="email" id="email" class="box" placeholder="Email" required>
            </div>

            <label for="password">Password</label>
            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" name="password" id="password" class="box" placeholder="Password" required>
                <i class="fas icon fa-eye-slash password-toggle" onclick="togglePassword(this)"></i>
            </div>

            <a href="#"><span>Forgot Password?</span></a>
            <button type="submit" name="login-btn" id="submit" class="btn btn-block btn-success">Login</button>
        </form>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
    function togglePassword(icon) {
        const passwordField = icon.previousElementSibling;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }
</script>

<?php
session_start();
include('includes/header.php');
?>


<div class="container">

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
?>
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
            <button type="submit" name="login-btn" id="submit" class="btn btn-primary text-bold">LOG IN</button>
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

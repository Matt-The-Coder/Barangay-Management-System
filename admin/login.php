<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Login - Barangay Management System</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/login.css">

    <!--<title>Login & Registration Form</title>-->
</head>

<body>
    <?php include 'templates/loading_screen.php' ?>
    <div class="container">

        <div class="forms">

            <div class="form login">
                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                        <?= $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif ?>
                <span class="title">Login</span>
                <form method="POST" action="model/login.php">
                    <div class="input-field">

                        <input id="username" name="username" type="text" placeholder="Enter username" required>
                        <i class="ri-user-5-line icon"></i>
                    </div>
                    <div class="input-field">

                        <input id="password" name="password" type="password" class="password" placeholder="Enter your password" required>
                        <i class="ri-lock-password-line icon"></i>
                        <i class="ri-eye-close-line showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login">
                    </div>
                </form>

            </div>

        </div>
    </div>
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/login.js"></script>
</body>

</html>
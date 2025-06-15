<?php 

    require './config/consts.php';
    
    // get back form data if there was a registration error
    $firstname = $_SESSION['register-data']['firstname'] ?? null;
    $lastname = $_SESSION['register-data']['lastname'] ?? null;
    $username = $_SESSION['register-data']['username'] ?? null;
    $email = $_SESSION['register-data']['email'] ?? null;
    $password = $_SESSION['register-data']['password'] ?? null;
    $confirm_password = $_SESSION['register-data']['confirm_password'] ?? null;

    unset($_SESSION['register-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?=ROOT_URL ?>assets/css/style.css">

    <!-- JAVASCRIPT -->
    <script src="<?=ROOT_URL ?>assets/js/main.js"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>

<body>

<section class="form-section">
    <div class="container form-section-container">
        <h2>Register</h2>
        <?php if(isset($_SESSION['register'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['register'];
                    unset($_SESSION['register']);
                ?></p>
            </div>
        <?php endif ?>
        <form action="<?=ROOT_URL ?>register-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" placeholder="First Name" name="firstname" value="<?= $firstname ?>">
            <input type="text" placeholder="Last Name" name="lastname" value="<?= $lastname ?>">
            <input type="text" placeholder="User Name" name="username" value="<?= $username ?>">
            <input type="email" placeholder="Email" name="email" value="<?= $email ?>">
            <input type="password" placeholder="Create Password" name="password" value="<?= $password ?>">
            <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?= $confirm_password ?>">
            <div class="form-control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <button class="btn" type="submit" name="submit">Register</button>
            <small>Already have an account? <a href="login.php">Login</a> </small>
        </form>
    </div>
</section>

    
</body>
</html>
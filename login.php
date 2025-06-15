<?php
require './config/consts.php';

$username_email = $_SESSION['login-data']['username_email'] ?? null;
$password = $_SESSION['login-data']['password'] ?? null;

unset($_SESSION['login-data']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- JAVASCRIPT -->
    <script src="./assets/js/main.js"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>

<body>

    <section class="form-section">
        <div class="container form-section-container">
            <h2>Login</h2>
            <?php if (isset($_SESSION['register-success'])): ?>
                <div class="alert-message success">
                    <p>
                        <?= $_SESSION['register-success'];
                        unset($_SESSION['register-success']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <?php if (isset($_SESSION['login'])): ?>
                <div class="alert-message error">
                    <p>
                        <?= $_SESSION['login'];
                        unset($_SESSION['login']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>login-logic.php" method="post">
                <input type="text" placeholder="User Name or Email" name="username_email" value="<?= $username_email ?>">
                <input type="password" placeholder="Password" name="password" value="<?= $password ?>">
                <button class="btn" type="submit" name="submit">Login</button>
                <small>Don't have an account? <a href="register.php">Register</a> </small>
            </form>
        </div>
    </section>


</body>

</html>
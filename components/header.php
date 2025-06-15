<?php
require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL?>assets/css/style.css">

    <!-- JAVASCRIPT -->
    <script src="<?= ROOT_URL?>assets/js/main.js"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>

<body>
    <!-- ====================== BEGIN NAV SECTION =================== -->
    <nav>
        <div class="container nav-container">
            <a class="nav-logo" href="<?= ROOT_URL?>">HIGHLAND</a>
            <ul class="nav-items">
                <li><a href="<?= ROOT_URL?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav-profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL?>assets/img/upload/<?=$_SESSION['user-avatar']?>"  alt="">
                        </div>
                        <ul>
                            <li><a href="<?= ROOT_URL?>admin/">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL?>logout.php">Log out</a></li>

                        </ul>
                    </li>
                <?php else: ?> 
                    <li><a href="<?= ROOT_URL ?>login.php">Login</a></li>
                <?php endif ?>

            </ul>
            <button id="open-nav-btn"><i class="bi bi-list"></i></button>
            <button id="close-nav-btn"><i class="bi bi-x-lg"></i></button>
        </div>
    </nav>

    <!-- ====================== END NAV SECTION =================== -->
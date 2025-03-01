<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">

    <!-- JAVASCRIPT -->
    <script src="../../public/assets/js/main.js"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>

<body>

    <!-- ====================== BEGIN NAV SECTION =================== -->
    <nav>
        <div class="container nav-container">
            <a class="nav-logo" href="../../public/index.php">HIGHLAND</a>
            <ul class="nav-items">
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./services.php">Services</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <!-- <li><a href="../app/views/login.php">Login</a></li> -->
                <li class="nav-profile">
                    <div class="avatar">
                        <img src="../../public/assets/img/avatar1.jpg" alt="">
                    </div>
                    <ul>
                        <li><a href="../app/views/dashboard.php">Dashboard</a></li>
                        <li><a href="../app/views/logout.php">Log out</a></li>

                    </ul>
                </li>
            </ul>
            <button id="open-nav-btn"><i class="bi bi-list"></i></button>
            <button id="close-nav-btn"><i class="bi bi-x-lg"></i></button>
        </div>
    </nav>

    <!-- ====================== END NAV SECTION =================== -->


    <section class="form-section">
        <div class="container form-section-container">
            <h2>Edit Category</h2>
            <form action="">
                <input type="text" placeholder="Title">
                <textarea rows="4" placeholder="Description"></textarea>
                <button class="btn" type="submit">Update Category</button>
            </form>
        </div>
    </section>

    <!-- ====================== BEGIN FOOTER SECTION =================== -->
    <footer>
        <div class="footer-socials">
            <a href="https://www.youtube.com/" target="_blank"><i class="bi bi-youtube"></i></a>
            <a href="https://www.facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="https://x.com/" target="_blank"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="container footer-container">
            <article>
                <h4>Category</h4>
                <ul>
                    <li><a href="">Science & Technology</a></li>
                    <li><a href="">Wild Life</a></li>
                    <li><a href="">Art</a></li>
                    <li><a href="">Food</a></li>
                    <li><a href="">Music</a></li>
                    <li><a href="">Travel</a></li>
                </ul>
            </article>

            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="">Online Support</a></li>
                    <li><a href="">Call Numbers</a></li>
                    <li><a href="">Emails</a></li>
                    <li><a href="">Socail Support</a></li>
                    <li><a href="">Location</a></li>
                </ul>
            </article>

            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Safety</a></li>
                    <li><a href="">Repair</a></li>
                    <li><a href="">Recent</a></li>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Categories</a></li>
                </ul>
            </article>

            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </article>
        </div>
        <div class="footer-copyright">
            <small>Copyright &copy; MR.HIGHLAND</small>
        </div>
    </footer>

    <!-- ====================== END FOOTER SECTION =================== -->


</body>

</html>
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

<section class="form-section">
    <div class="container form-section-container">
        <h2>Register</h2>
        <div class="alert-message error">
            <p>This is an error message</p>
        </div>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="First Name">
            <input type="text" placeholder="Last Name">
            <input type="text" placeholder="User Name">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Create Password">
            <input type="password" placeholder="Confirm Password">
            <div class="form-control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar">
            </div>
            <button class="btn" type="submit">Register</button>
            <small>Already have an account? <a href="login.php">Login</a> </small>
        </form>
    </div>
</section>

    
</body>
</html>
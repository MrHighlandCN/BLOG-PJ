<?php
require 'config/database.php';

// if submit buttion was clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // Validate input
    if (!$firstname) {
        $_SESSION['register'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['register'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['register'] = "Please enter your Username";
    } elseif (!$email) {
        $_SESSION['register'] = "Please enter a valid email";
    } elseif (strlen($password) < 8 ||  strlen($confirm_password) < 8) {
        $_SESSION['register'] = "Password should be more than 8 characters";
    } elseif (!$avatar['name']) {
        $_SESSION['register'] = "Please add avatar";
    } else {
        // Check if password match or not
        if ($password !== $confirm_password) {
            $_SESSION['register'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $user_check_result = mysqli_query($conn, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['register'] = "Username or Email already exist";
            } else {
                // WORK ON AVATAR
                $time = time(); // make each image name unique;
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'assets/img/upload/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $avatar_name);
                $extension = end($extension);

                if (in_array($extension, $allowed_files)) {
                    // make sure image is not too large
                    if ($avatar['size'] < 1000000) {
                        //upload image
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['register'] = "File size is too big. should be less than 1mb";
                    }
                } else {
                    $_SESSION['register'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }
    // redirect to register page if there was any problem
    if (isset($_SESSION['register'])) {
        // pass form data back to register page
        $_SESSION['register-data'] = $_POST;
        header('location: ' . ROOT_URL . 'register.php');
        die();
    } else {
        // insert new user
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0)";
        $insert_user_result = mysqli_query($conn, $insert_user_query);
        
        if(!mysqli_errno($conn)) {
            //redirect to login page with success message
            $_SESSION['register-success'] = "Registration successful. Please log in!";
            header('location: ' . ROOT_URL . 'login.php');
            die();
            
        }
    }
} else {
    // if submit buttion wasn't clicked

    header('location: ' . ROOT_URL . 'register.php');
    die();
}

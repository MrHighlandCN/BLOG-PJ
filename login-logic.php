<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['login'] = "Username or Email is required";
    } elseif (!$password) {
        $_SESSION['login'] = "Password is required";
    } else {
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($conn, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            // convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // compare password
            if (password_verify($password, $db_password)) {
                // set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                $_SESSION['user-avatar'] = $user_record['avatar'];
                // set session if user is an admin
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                // log user in
                header('location: ' . ROOT_URL . "admin/");
            } else {
                $_SESSION['login'] = "Wrong password";
            }
        } else {
            $_SESSION['login'] = "User not found";
        }

        // if any problem, redirect
        if(isset($_SESSION['login'])) {
            $_SESSION['login-data'] = $_POST;
            header('location: ' . ROOT_URL . "login.php");
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . "login.php");
    die();
}

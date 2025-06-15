<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = isset($_POST['is_featured']) ? filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT) : 0;
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate data
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Enter post body";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnai";
    } else {
        // WORK ON THUMBNAIL
        $time = time(); // make each image name unique;
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path =  '../assets/img/upload/' . $thumbnail_name;

        //make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);

        if (in_array($extension, $allowed_files)) {
            // make sure image is not too large
            if ($thumbnail['size'] < 2000000) {
                //upload image
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "File size is too big. should be less than 2mb";
            }
        } else {
            $_SESSION['add-post'] = "File should be png, jpg, or jpeg";
        }
    }

    // redirect to add-post page if there was any problem
    if (isset($_SESSION['add-post'])) {
        // pass form data back to add-post page
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
        if($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($conn, $zero_all_is_featured_query);
        }
        // insert new post
        $insert_post_query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";
        $insert_post_result = mysqli_query($conn, $insert_post_query);

        if (!mysqli_errno($conn)) {
            //redirect to login page with success message
            $_SESSION['add-post-success'] = "New post $title added";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }
} else {
    // if submit buttion wasn't clicked

    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();
}
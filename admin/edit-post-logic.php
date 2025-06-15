<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = isset($_POST['is_featured']) ? filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT) : 0;
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate data
    if (!$title || !$category_id || !$body) {
        $_SESSION['edit-post'] = "Invalid form input";
    } else {
        // WORK ON THUMBNAIL
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../assets/img/upload/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }


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
                    $_SESSION['edit-post'] = "File size is too big. should be less than 2mb";
                }
            } else {
                $_SESSION['edit-post'] = "File should be png, jpg, or jpeg";
            }
        }

        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($conn, $zero_all_is_featured_query);
        }
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        // edit post
        $edit_post_query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $edit_post_result = mysqli_query($conn, $edit_post_query);

        if (!mysqli_errno($conn)) {
            //redirect to login page with success message
            $_SESSION['edit-post-success'] = "Post $title edited";
        } else {
            $_SESSION['edit-post'] = "Failed to update post";
        }
    }
}
header('location: ' . ROOT_URL . 'admin/');
die();

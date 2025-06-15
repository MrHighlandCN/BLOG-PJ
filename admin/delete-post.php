<?php 
    require 'config/database.php';

    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        //fetch post
        $query = "SELECT * FROM posts WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $post = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1) {
            $thumbnail_name = $post['thumbnail'];
            $thumbnail_path = '../assets/img/upload/' . $thumbnail_name;
            if($thumbnail_path)
            {
                unlink($thumbnail_path);
            }

        }


        //delete post from database
        $delete_post_query = "DELETE FROM posts WHERE id=$id";
        $delete_post_result = mysqli_query($conn, $delete_post_query);

        if(mysqli_errno($conn))
        {
            $_SESSION['delete-post'] = "Failed to delete post";

        }
        else {
            $_SESSION['delete-post-success'] = "Delete post successfully";
        }
    }

    header('location: '. ROOT_URL . 'admin/');
?>
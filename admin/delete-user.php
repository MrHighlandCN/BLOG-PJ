<?php 
    require 'config/database.php';

    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        //fetch user
        $query = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) == 1) {
            $avatar_name = $user['avatar'];
            $avatar_path = '../assets/img/upload/' . $avatar_name;
            if($avatar_path)
            {
                unlink($avatar_path);
            }

        }

        //FOR Later
        //delete all user's post


        //delete user from database
        $delete_user_query = "DELETE FROM users WHERE id=$id";
        $delete_user_result = mysqli_query($conn, $delete_user_query);

        if(mysqli_errno($conn))
        {
            $_SESSION['delete-user'] = "Failed to delete user";

        }
        else {
            $_SESSION['delete-user-success'] = "Delete user successfully";
        }
    }

    header('location: '. ROOT_URL . 'admin/manage-users.php');
?>
<?php 
    require 'config/database.php';

    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        //FOR Later
        //delete all category's post


        //delete category from database
        $delete_category_query = "DELETE FROM categories WHERE id=$id";
        $delete_category_result = mysqli_query($conn, $delete_category_query);

        if(mysqli_errno($conn))
        {
            $_SESSION['delete-category'] = "Failed to delete category";

        }
        else {
            $_SESSION['delete-category-success'] = "Delete category successfully";
        }
    }

    header('location: '. ROOT_URL . 'admin/manage-categories.php');
?>
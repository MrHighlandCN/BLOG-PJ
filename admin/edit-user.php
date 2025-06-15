<?php
include 'components/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id = $id LIMIT 1";

    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
}

?>


<section class="form-section">
    <div class="container form-section-container">
        <h2>Edit User</h2>
        <?php if (isset($_SESSION['edit-user'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                    ?></p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="post">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <input type="text" placeholder="First Name" name="firstname" value="<?= $user['firstname'] ?>">
            <input type="text" placeholder="Last Name" name="lastname" value="<?= $user['lastname'] ?>">
            <select name="user_role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <button class="btn" type="submit" name="submit">Update user</button>
        </form>
    </div>
</section>

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>

<?php
include 'components/header.php';

// get back form data if there was a registration error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$confirm_password = $_SESSION['add-user-data']['confirm_password'] ?? null;

unset($_SESSION['add-user-data']);
?>


<section class="form-section">
    <div class="container form-section-container">
        <h2>Add User</h2>
        <?php if (isset($_SESSION['add-user'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?></p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" placeholder="First Name" name="firstname" value="<?= $firstname ?>">
            <input type="text" placeholder="Last Name" name="lastname" value="<?= $lastname ?>">
            <input type="text" placeholder="User Name" name="username" value="<?= $username ?>">
            <input type="email" placeholder="Email" name="email" value="<?= $email ?>">
            <input type="password" placeholder="Create Password" name="password" value="<?= $password ?>">
            <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?= $confirm_password ?>">
            <select name="user_role">

                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form-control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <button class="btn" type="submit" name="submit">Add user</button>
        </form>
    </div>
</section>

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>
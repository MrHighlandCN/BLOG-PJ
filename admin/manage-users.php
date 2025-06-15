<?php
include 'components/header.php';


if (!isset($_SESSION['user_is_admin'])) {
    header('location: ' . ROOT_URL . "admin/");
}

// fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE id != $current_admin_id";

$users = mysqli_query($conn, $query);
?>

<section class="dashboard">
    <?php if (isset($_SESSION['add-user-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-user-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-user'])): ?>
        <div class="alert-message error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user'])): ?>
        <div class="alert-message error container">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard-container">
        <button id="show-sidebar-btn" class="sidebar-toggle"><i class="bi bi-caret-right-fill"></i></button>
        <button id="hide-sidebar-btn" class="sidebar-toggle"><i class="bi bi-caret-left-fill"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php">
                        <i class="bi bi-pencil"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <i class="bi bi-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>

                <li>
                    <a href="add-user.php">
                        <i class="bi bi-person-plus"></i>
                        <h5>Add User</h5>
                    </a>
                </li>

                <li>
                    <a href="manage-users.php" class="active">
                        <i class="bi bi-people"></i>
                        <h5>Manage Users</h5>
                    </a>
                </li>

                <li>
                    <a href="add-category.php">
                        <i class="bi bi-pencil-square"></i>
                        <h5>Add Category</h5>
                    </a>
                </li>

                <li>
                    <a href="manage-categories.php">
                        <i class="bi bi-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php if (mysqli_num_rows($users) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td><?= "{$user['username']}" ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
                                <td>
                                    <?= $user['is_admin'] ? 'Yes' : 'No' ?>


                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert-message error">
                    <p>
                        No user found
                    </p>
                </div>
            <?php endif ?>

        </main>
    </div>
</section>



<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>
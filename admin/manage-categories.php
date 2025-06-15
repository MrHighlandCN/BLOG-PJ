<?php
include 'components/header.php';

if (!isset($_SESSION['user_is_admin'])) {
    header('location: ' . ROOT_URL . "admin/");
}

// fetch all categories from database 
$query = "SELECT * FROM categories ORDER BY title ASC";

$categories = mysqli_query($conn, $query);
?>


<section class="dashboard">
    <?php if (isset($_SESSION['add-category-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-category-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-category'])): ?>
        <div class="alert-message error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-category'])): ?>
        <div class="alert-message error container">
            <p>
                <?= $_SESSION['delete-category'];
                unset($_SESSION['delete-category']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-category-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
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
                    <a href="manage-users.php">
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
                    <a href="manage-categories.php" class="active">
                        <i class="bi bi-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if (mysqli_num_rows($categories) > 0): ?>

                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                            <tr>
                                <td><?= $category['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>

                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert-message error">
                    <p>
                        No category found
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
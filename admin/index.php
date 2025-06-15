<?php
include 'components/header.php';

// fetch all posts from database 
$current_user_id = $_SESSION['user-id'];
$query = "
    SELECT posts.*, categories.title AS category_title
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    WHERE posts.author_id = $current_user_id
    ORDER BY posts.id ASC
";
$posts = mysqli_query($conn, $query);
?>

<section class="dashboard">
    <?php if (isset($_SESSION['add-post-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-post-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>

    <?php elseif (isset($_SESSION['edit-post'])): ?>
        <div class="alert-message error container">
            <p>
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-post'])): ?>
        <div class="alert-message error container">
            <p>
                <?= $_SESSION['delete-post'];
                unset($_SESSION['delete-post']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-post-success'])): ?>
        <div class="alert-message success container">
            <p>
                <?= $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
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
                    <a href="index.php" class="active">
                        <i class="bi bi-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])): ?>
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
                        <a href="manage-categories.php">
                            <i class="bi bi-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>

            </ul>
        </aside>
        <main>
            <h2>Dashboard</h2>
            <?php if (mysqli_num_rows($posts) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['category_title'] ?: "Không có" ?></td>
                                <td><a href="<?=ROOT_URL?>admin/edit-post.php?id=<?=$post['id']?>" class="btn sm">Edit</a></td>
                                <td><a href="<?=ROOT_URL?>admin/delete-post.php?id=<?=$post['id']?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert-message error">
                    <p>
                        No post found
                    </p>
                </div>
            <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../components/footer.php';
?>
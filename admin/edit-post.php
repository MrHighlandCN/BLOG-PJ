<?php
include 'components/header.php';

if (isset($_GET['id'])) {
    // fetch all categories from database 
    $query = "SELECT * FROM categories ORDER BY title ASC";
    $categories = mysqli_query($conn, $query);

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM posts WHERE id = $id LIMIT 1";

    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-posts.php');
}
?>

<section class="form-section">
    <div class="container form-section-container">
        <h2>Edit Post</h2>
        <?php if (isset($_SESSION['edit-post'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']);
                    ?></p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?= $post['id'] ?>" name="id">
            <input type="hidden" value="<?= $post['thumbnail'] ?>" name="previous_thumbnail_name">
            <input type="text" placeholder="Title" name="title" value="<?= $post['title'] ?>">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $post['category_id'] ? "selected" : "" ?>><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <?php if (isset($_SESSION['user_is_admin'])): ?>
                <div class="form-control inline">
                    <input type="checkbox" id="is-featured" name="is_featured" <?= $post['is_featured'] ? "checked" : "" ?> value="1">
                    <label for="is-featured">Featured</label>
                </div>
            <?php endif ?>
            <div class="form-control">
                <label for="thumbnail">Update Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>
            <textarea rows="4" placeholder="Body" name="body" value="<?= $post['body'] ?>"><?= $post['body'] ?></textarea>
            <button class="btn" type="submit" name="submit">Update Post</button>
        </form>
    </div>
</section>

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>
<?php
include 'components/header.php';

// fetch all categories from database 
$query = "SELECT * FROM categories ORDER BY title ASC";

$categories = mysqli_query($conn, $query);

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

unset($_SESSION['add-post-data']);
?>


<section class="form-section">
    <div class="container form-section-container">
        <h2>Add Post</h2>
        <?php if (isset($_SESSION['add-post'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?></p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" placeholder="Title" name="title" value="<?= $title ?>">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php endwhile ?>
            </select>
            <?php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="form-control inline">
                <input type="checkbox" id="is-featured" checked name="is_featured" value="1">
                <label for="is-featured">Featured</label>
            </div>
            <?php endif ?>

            <div class="form-control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>
            <textarea rows="4" placeholder="Body" name="body" value="<?= $body ?>"><?= $body ?></textarea>
            <button class="btn" type="submit" name="submit">Add Post</button>
        </form>
    </div>
</section>

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>
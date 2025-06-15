<?php
include 'components/header.php';

$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;
?>


<section class="form-section">
    <div class="container form-section-container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?></p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="post">
            <input type="text" placeholder="Title" name="title" value="<?= $title ?>">
            <textarea rows="4" placeholder="Description" name="description" value="<?= $description ?>"><?= $description ?></textarea>
            <button class="btn" type="submit" name="submit">Add Category</button>
        </form>
    </div>
</section>

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>
<?php
include 'components/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categories WHERE id = $id LIMIT 1";

    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
}
?>

<section class="form-section">
    <div class="container form-section-container">
        <h2>Edit Category</h2>
        <?php if (isset($_SESSION['edit-category'])): ?>
            <div class="alert-message error">
                <p><?=
                    $_SESSION['edit-category'];
                    unset($_SESSION['edit-category']);
                    ?></p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="post">
            <input type="hidden" value="<?= $category['id'] ?>" name="id">
            <input type="text" placeholder="Title" name="title" value="<?= $category['title'] ?>">
            <textarea rows="4" placeholder="Description" name="description" value="<?= $category['description'] ?>"><?= htmlspecialchars($category['description']) ?></textarea>
            <button class="btn" type="submit" name="submit">Update Category</button>
        </form>
    </div>
</section>

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include '../components/footer.php';
?>
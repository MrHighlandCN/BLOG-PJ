<?php
include 'components/header.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $post_query = " SELECT posts.*, 
    categories.title AS category_title,
    CONCAT(users.firstname, ' ', users.lastname) AS author_name,
    users.avatar AS author_avatar
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    LEFT JOIN users ON posts.author_id = users.id
    WHERE posts.id = $id LIMIT 1
";
    $post_result = mysqli_query($conn, $post_query);
    $post = mysqli_fetch_assoc($post_result);
} else {
    header('location: ' . ROOT_URL);
}
?>

<!-- ====================== BEGIN SINGLE POST SECTION =================== -->
<section class="singlepost">
    <div class="container singlepost-container">
        <h2><?= $post['title'] ?></h2>
        <div class="post-author">
            <div class="post-author-avatar">
                <img src="<?= ROOT_URL ?>assets/img/upload/<?= $post['author_avatar'] ?>" alt="">
            </div>
            <div class="post-author-info">
                <h5>By: <?= $post['author_name'] ?></h5>
                <small>
                    <?= date("F j, Y - H:i", strtotime($post['date'])) ?>
                </small>
            </div>
        </div>
        <div class="singlepost-thumbnail">
            <img src="<?= ROOT_URL ?>assets/img/upload/<?= $post['thumbnail'] ?>" alt="">

        </div>
        <p>
            <?= $post['body'] ?>
        </p>

    </div>
</section>

<!-- ====================== END SINGLE POST SECTION =================== -->

<!-- ====================== BEGIN FOOTER SECTION =================== -->
<?php
include 'components/footer.php'
?>
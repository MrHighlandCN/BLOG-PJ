<?php
include 'components/header.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $category_query = "SELECT * FROM categories WHERE id = $id LIMIT 1";
    $category_result = mysqli_query($conn, $category_query);
    if (mysqli_num_rows($category_result) > 0) {
        $category = mysqli_fetch_assoc($category_result);
        // Có dữ liệu, xử lý tại đây
    } else {
        header('location: ' . ROOT_URL);
    }


    $posts_query = " SELECT posts.*, 
    categories.title AS category_title,
    CONCAT(users.firstname, ' ', users.lastname) AS author_name,
    users.avatar AS author_avatar
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    LEFT JOIN users ON posts.author_id = users.id
    WHERE posts.category_id = $id
    ORDER BY posts.date DESC
";
    $posts_result = mysqli_query($conn, $posts_query);
} else {
    header('location: ' . ROOT_URL);
}
?>
<!-- ====================== BEGIN TITLE SECTION =================== -->

<header class="category-title">
    <h2><?= $category['title'] ?></h2>
</header>
<!-- ====================== END TITLE SECTION =================== -->


<!-- ====================== BEGIN POST SECTION =================== -->
<section class="posts">
    <div class="container posts-container">
        <?php while ($post = mysqli_fetch_assoc($posts_result)): ?>
            <article class="post">
                <div class="post-thumbnail">
                    <img src="<?= ROOT_URL ?>assets/img/upload/<?= $post['thumbnail'] ?>" alt="">
                </div>
                <div class="post-info">
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category-btn"><?= $post['category_title'] ?></a>
                    <h3 class="post-title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                            <?= $post['title'] ?>
                        </a>
                    </h3>
                    <p class="post-body">
                        <?= substr(strip_tags($post['body']), 0, 200) . '...' ?>

                    </p>
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
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>
<!-- ====================== END FEATURED SECTION =================== -->

<!-- ====================== BEGIN CATEGORY BUTTON SECTION =================== -->
<section class="category-btns">
    <div class="container category-btns-container">
        <a href="" class="category-btn">Science & Technology</a>
        <a href="" class="category-btn">Wild Life</a>
        <a href="" class="category-btn">Art</a>
        <a href="" class="category-btn">Food</a>
        <a href="" class="category-btn">Music</a>
        <a href="" class="category-btn">Travel</a>
    </div>
</section>
<!-- ====================== END CATEGORY BUTTON SECTION =================== -->


<?php
include 'components/footer.php'
?>
<?php
include 'components/header.php';

// Fetch categories
$query = "SELECT * FROM categories ORDER BY title ASC";
$categories = mysqli_query($conn, $query);

// Kiểm tra nếu có tìm kiếm
$search = '';
if (isset($_GET['content']) && !empty(trim($_GET['content']))) {
    $search = filter_var($_GET['content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $all_posts_query = " SELECT posts.*, 
        categories.title AS category_title,
        CONCAT(users.firstname, ' ', users.lastname) AS author_name,
        users.avatar AS author_avatar
        FROM posts
        LEFT JOIN categories ON posts.category_id = categories.id
        LEFT JOIN users ON posts.author_id = users.id
        WHERE (posts.title LIKE '%$search%' OR posts.body LIKE '%$search%')
        ORDER BY posts.date DESC
    ";
} else {
    // Truy vấn tất cả nếu không có tìm kiếm
    $all_posts_query = " SELECT posts.*, 
        categories.title AS category_title,
        CONCAT(users.firstname, ' ', users.lastname) AS author_name,
        users.avatar AS author_avatar
        FROM posts
        LEFT JOIN categories ON posts.category_id = categories.id
        LEFT JOIN users ON posts.author_id = users.id
        ORDER BY posts.date DESC
    ";
}

$all_posts_result = mysqli_query($conn, $all_posts_query);
?>


<!-- ====================== BEGIN SEARCH BAR SECTION =================== -->
<section class="search-bar">
    <form class="container search-bar-container" action="<?= ROOT_URL ?>blog.php" method="get">
        <div>
            <i class="bi bi-search"></i>
            <input type="search" name="content" placeholder="Search">
        </div>
        <button type="submit" class="btn">Go</button>
    </form>
</section>
<!-- ====================== END SEARCH BAR SECTION =================== -->


<!-- ====================== BEGIN POST SECTION =================== -->
<section class="posts">
    <div class="container posts-container">
        <?php while ($post = mysqli_fetch_assoc($all_posts_result)): ?>
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
<!-- ====================== END POSTS SECTION =================== -->

<!-- ====================== BEGIN CATEGORY BUTTON SECTION =================== -->
<section class="category-btns">
    <div class="container category-btns-container">
        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category-btn"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!-- ====================== END CATEGORY BUTTON SECTION =================== -->



<!-- ====================== BEGIN FOOTER SECTION =================== -->

<?php
include 'components/footer.php'
?>
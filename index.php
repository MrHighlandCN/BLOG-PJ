    <!-- HEADER SECTION -->
    <?php
    include 'components/header.php';

    // fetch all categories from database 
    $query = "SELECT * FROM categories ORDER BY title ASC";
    $categories = mysqli_query($conn, $query);


    $featured_post_query = " SELECT posts.*, 
    categories.title AS category_title,
    CONCAT(users.firstname, ' ', users.lastname) AS author_name,
    users.avatar AS author_avatar
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    LEFT JOIN users ON posts.author_id = users.id
    WHERE posts.is_featured = 1
    ORDER BY posts.date DESC LIMIT 1
";
    $featured_post_result = mysqli_query($conn, $featured_post_query);
    $featured_post = mysqli_fetch_assoc($featured_post_result);


    $all_posts_query = " SELECT posts.*, 
    categories.title AS category_title,
    CONCAT(users.firstname, ' ', users.lastname) AS author_name,
    users.avatar AS author_avatar
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    LEFT JOIN users ON posts.author_id = users.id
    WHERE posts.is_featured = 0
    ORDER BY posts.date DESC
";
    $all_posts_result = mysqli_query($conn, $all_posts_query);
    ?>


    <!-- ====================== BEGIN FEATURED SECTION =================== -->
    <?php if ($featured_post): ?>
        <section class="featured">
            <div class="container featured-container">
                <div class="post-thumbnail">
                    <img src="<?= ROOT_URL ?>assets/img/upload/<?= $featured_post['thumbnail'] ?>" alt="">
                </div>
                <div class="post-info">
                    <a href="<?=ROOT_URL?>category-posts.php?id=<?= $featured_post['category_id'] ?>" class="category-btn"><?= $featured_post['category_title'] ?></a>
                    <h2 class="post-title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $featured_post['id'] ?>">
                            <?= $featured_post['title'] ?>
                        </a>
                    </h2>
                    <p class="post-body">
                        <?= substr(strip_tags($featured_post['body']), 0, 200) . '...' ?>
                    </p>

                    <div class="post-author">
                        <div class="post-author-avatar">
                            <img src="<?= ROOT_URL ?>assets/img/upload/<?= $featured_post['author_avatar'] ?>" alt="">
                        </div>
                        <div class="post-author-info">
                            <h5>By: <?= $featured_post['author_name'] ?></h5>
                            <small>
                                <?= date("F j, Y - H:i", strtotime($featured_post['date'])) ?>
                            </small>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>

    <!-- ====================== END FEATURED SECTION =================== -->


    <!-- ====================== BEGIN POST SECTION =================== -->
    <section class="posts">
        <div class="container posts-container">
            <?php while ($post = mysqli_fetch_assoc($all_posts_result)): ?>
                <article class="post">
                    <div class="post-thumbnail">
                        <img src="<?= ROOT_URL ?>assets/img/upload/<?= $post['thumbnail'] ?>" alt="">
                    </div>
                    <div class="post-info">
                        <a href="<?=ROOT_URL?>category-posts.php?id=<?= $post['category_id'] ?>" class="category-btn"><?= $post['category_title'] ?></a>
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
            <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                <a href="<?=ROOT_URL?>category-posts.php?id=<?= $category['id'] ?>" class="category-btn"><?= $category['title'] ?></a>
            <?php endwhile ?>
        </div>
    </section>
    <!-- ====================== END CATEGORY BUTTON SECTION =================== -->



    <!-- ====================== BEGIN FOOTER SECTION =================== -->
    <?php
    include 'components/footer.php'
    ?>
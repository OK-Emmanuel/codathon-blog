<?php 
require_once("./partials/header.php");
// Fetch featured post
$featured_post = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_post);
$featured = mysqli_fetch_assoc($featured_result);

// Fetch 9 posts from database
$query = "SELECT * FROM posts ORDER by date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);
?>

    <!-- Show featured post if there's any -->

    <?php  if(mysqli_num_rows($featured_result) == 1): ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?= $featured['thumbnail']; ?>" alt="">
            </div>

            <div class="post__info">
                <?php 
                // Fetch category
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE cat_id = $category_id";
                $category_result  = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                
                ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['cat_id']; ?>" class="category__button"><?= $category['title']; ?></a>
                <h2 class="post_title"><a href="<?= ROOT_URL ?>posts.php?id=<?= $featured['id']; ?>"><?= $featured['title']; ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['body'], 0, 300); ?>... 
                </p>
                <div class="post__author">
                    <?php 
                    // Fetch associated author
                    $author_id =  $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE user_id = $author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post__author-avatar">
                        <img src="images/<?= $author['avatar'] ; ?>" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?= $author['firstname'] . " " . $author['lastname']; ?></h5>
                        <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

<!-- ======================================== END OF FEATURED POST============================= -->

    <section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
        <div class="container posts__container">
            
        <!-- Loop available posts -->
        <?php while($post = mysqli_fetch_assoc($posts)): ?>
            
        <article class="post">
                <div class="post__thumbnail">
                    <img src="images/<?=$post['thumbnail']; ?>" alt="">
                </div>
                <div class="post__info">

                <?php 
                // Fetch category
                $category_id = $post['category_id'];
                $category_query = "SELECT * FROM categories WHERE cat_id = $category_id";
                $category_result  = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                
                ?>

                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id']; ?>" class="category__button"><?= $category['title']; ?></a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>posts.php?id=<?= $post['id']; ?>"><?=$post['title']; ?></a>
                    </h3>
                    <p class="post__body"><?= substr($post['body'], 0, 100); ?>... </p>
                    
                    <?php 
                    // Fetch associated author
                    $author_id =  $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE user_id = $author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>

                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="images/<?= $author['avatar']; ?>" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By <?= $author['firstname'] . " " . $author['lastname']; ?> </h5>
                            <small><?= date("M d, Y - H:i", strtotime($post['date_time'])); ?></small>
                        </div>
                    </div>
                </div>
            </article> 
            
            <?php endwhile; ?>
        </div>
    </section>

    <!-- /*  
    ======================================================
    END OF POSTS
    ======================================================
     */ -->
   
    <section class="category__buttons">
        <div class="container category__buttons-container">
            <?php
                $all_categories_query = "SELECT * FROM categories"; 
                $all_categories = mysqli_query($connection, $all_categories_query);
                
                while($category = mysqli_fetch_assoc($all_categories)): ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['cat_id']; ?>" class="category__button"><?= $category['title']; ?></a>
            <?php endwhile; ?>        
        </div>
    </section>


<?php 
include 'partials/footer.php';
?>





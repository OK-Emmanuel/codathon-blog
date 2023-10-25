<?php 
require_once("./partials/header.php");

// Fetch all posts from database
$query = "SELECT * FROM posts ORDER by date_time DESC ";
$posts = mysqli_query($connection, $query);
?>

 
<!-- ======================================== END OF FEATURED POST============================= -->
    <section class="search__bar">
        <form action="<?= ROOT_URL ?>search.php" method="GET" class="container search__bar-container">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="Type your search query here" id="">
            <button type="submit" name="submit" class="btn ">Go</button>
        </div>
        
        </form>
    </section>



    <section class="posts">
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





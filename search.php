<?php 
require('partials/header.php');

if(isset($_GET['search']) && isset ($_GET['submit'])){
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
}
else{
    $_SESSION['error-message'] = "Type your search keyword";
    header("Location:" . ROOT_URL . 'blog.php');
    die(0);
}

?>


 <?php if(mysqli_num_rows($posts) >0 ): ?>       
<section class="posts section__extra-margin">
<h2 style="text-align: center; margin-bottom: 50px">Search Result(s)</h2>
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
<?php else: ?>
    <div class="alert__message error lg section__extra-margin">
            <h2 style="text-align: center">No Associated Post Found With Your Keyword</h2>
        </div>
    <?php endif; ?>
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





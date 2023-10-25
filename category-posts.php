<?php 
include_once('partials/header.php');


// Fetch category if ID is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
    
    }else{
        $_SESSION['error-message'] = "Select a category to view";
        header("Location: ". ROOT_URL . "blog.php" );
        die(0);
    }
?>

    <header class="category__title">
    <?php 
                // Fetch category
                $category_id = $id;
                $category_query = "SELECT * FROM categories WHERE cat_id = $category_id";
                $category_result  = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                echo "<h2> {$category['title']} </h2> ";
                ?>
    </header>



    <?php if(mysqli_num_rows($posts) > 0 ): ?>
    <section class="posts">
        <div class="container posts__container">
            
        <!-- Loop available posts -->
        <?php while($post = mysqli_fetch_assoc($posts)): ?>
            
        <article class="post">
                <div class="post__thumbnail">
                    <img src="images/<?=$post['thumbnail']; ?>" alt="">
                </div>
                <div class="post__info">
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
    <?php  else : ?>
        <div class="alert__message error lg">
            <h2 style="text-align: center">No Post Found for This Category</h2>
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






<!-- ==================== FOOTER ==================== -->
<?php include('partials/footer.php'); ?>
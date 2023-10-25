<?php 
require_once("partials/header.php");

// Fetch post if ID is set
if(isset($_GET['id'])){
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$query = "SELECT * FROM posts WHERE id=$id";
$result = mysqli_query($connection, $query);
$post = mysqli_fetch_assoc($result);

}else{
    $_SESSION['error-message'] = "Select a post to read";
    header("Location: ". ROOT_URL . "blog.php" );
    die(0);
}
?>
    <!-- ================================  END OF NAV================ -->

  <section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $post['title']; ?> </h2>
        <hr>
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
    
        <div class="singlepost__thumbnail">
            <img src="images/<?= $post['thumbnail'] ?>" alt="">
        </div>

        <p>
           <?= $post['body']; ?>
        </p>
    </div>
  </section>

 
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
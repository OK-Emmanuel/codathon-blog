<?php 
require_once("partials/header.php");


// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);


if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // fetch category from database
    $query = "SELECT * FROM posts WHERE id='$id' ";
    $result =  mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);
    }
}else{
    header("Location:" .ROOT_URL."admin");
    die(0);
}
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
      
        <?php if(isset($_SESSION['error-message'])): ?>
        <div class="alert__message error">
            <p><?= $_SESSION['error-message']; ?> </p>
            <?php unset($_SESSION['error-message']); ?>
        </div>

        <?php elseif(isset($_SESSION['success-message'])): ?>
        <div class="alert__message success">
            <p><?= $_SESSION['success-message']; ?> </p>
            <?php unset($_SESSION['success-message']); ?>
        </div>
        <?php endif; ?>

        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            
        <input type="hidden" name="id" value="<?= $post['id']; ?> ">
        <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail']; ?> ">
           
            <input type="text" name="title" value="<?= $post['title']; ?>" placeholder="Post title...">
            
            <select name="category" id="">
                <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['cat_id'] ?>"><?= $category['title']; ?> </option>
                <?php endwhile; ?>
            </select>

            <textarea rows="10" name="body" placeholder="Your post content here"><?= $post['body']; ?></textarea>

            <div class="form__control inline">
                <input type="checkbox" name="is_featured" id="is_featured" checked>
                <label for="is_featured">Featured</label>
                
            </div>

            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
                
            </div>

           
            <button type="submit" name="submit" class="btn ">Update Post</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> 
<?php 

require_once("partials/footer.php");
?>
<?php 
require_once("partials/header.php");

 
// get back form data in case of registration error
$title = $_SESSION['add-post-data']['title'] ?? NULL;
$category = $_SESSION['add-post-data']['category'] ?? NULL;
$body = $_SESSION['add-post-data']['body'] ?? NULL;


// Delete session data
unset($_SESSION['add-post-data']); ;

// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <!-- Display error message if available -->
        <?php if(isset($_SESSION['error-message'])): ?>
        <div class="alert__message error">
            <p><?= $_SESSION['error-message']; ?> </p>
            <?php unset($_SESSION['error-message']); ?>
        </div>

        <!-- display success message if available -->
        <?php elseif(isset($_SESSION['success-message'])): ?>
        <div class="alert__message success">
            <p><?= $_SESSION['success-message']; ?> </p>
            <?php unset($_SESSION['success-message']); ?>
        </div>
       <?php endif; ?>

        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
        
            <input type="text" value="<?= $title; ?>" name="title" placeholder="Post title...">
            
            <select name="category" id="">
                <?php while($category =  mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['cat_id']; ?>"><?= $category['title'] ?>  </option>
                    <?php endwhile; ?>
            </select>

            <textarea rows="10" name="body"  placeholder="Body"><?= $body; ?></textarea>


            <?php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="form__control inline">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" checked> 
                <label for="is_featured">Featured</label>
            </div>
            <?php endif; ?>

            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" checked>
                
            </div>

           
            <button type="submit" name="submit" class="btn ">Add Post</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== -->
<?php 

require_once("partials/footer.php");
?>
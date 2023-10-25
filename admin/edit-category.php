<?php 
require_once("partials/header.php");

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // fetch category from database
    $query = "SELECT * FROM categories WHERE cat_id='$id' ";
    $result =  mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_assoc($result);
    }
}else{
    header("Location: '.ROOT_URL.'admin/manage-categories.php");
}
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
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

        <form action="<?= ROOT_URL?>admin/edit-category-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['cat_id'];?>">
            <input type="text" name="title" value="<?= $category['title']; ?>" placeholder="Category title...">
            <textarea rows="4" name="description" placeholder="Description"><?= $category['description']; ?></textarea>
            <button type="submit" name="submit" class="btn ">Update Category</button>
            

        </form>
    </div>
</section>

<?php 

require_once("partials/footer.php");
?>
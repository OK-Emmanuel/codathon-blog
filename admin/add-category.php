<?php 

require_once("partials/header.php");
// get form input in return
$title = $_SESSION['add-category-data']['title'] ?? NULL;
$description = $_SESSION['add-category-data']['description'] ?? NULL;
unset($_SESSION['add-category-data']);
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

        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
        
            <input type="text" value="<?= $title ?>" name="title" placeholder="Category title...">
            <textarea rows="4" name="description" placeholder="Description"><?= $description; ?></textarea>
            <button type="submit" name="submit" class="btn ">Add Category</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> 
<?php 

require_once("../partials/footer.php");
?>
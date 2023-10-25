<?php 
require_once("partials/header.php");

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE user_id='$id' ";
    $result =  mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}else{
    header("Location: '.ROOT_URL.'admin/manage-users.php");
    die(0);
}
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        
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

        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user['user_id'];?>">
            <input type="text" value="<?= $user['firstname'] ;?>" placeholder="First Name..." name="firstname">
            <input type="text" value="<?= $user['lastname'] ;?>" placeholder="Last Name..." name="lastname">
        
            <select name="role" value=<?= $user['is_admin'] ?> id="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

    

            <button type="submit" name="submit" class="btn ">Save Changes</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> 
<?php 

require_once("partials/footer.php");
?>
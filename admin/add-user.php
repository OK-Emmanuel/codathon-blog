<?php 

require_once("partials/header.php");
 
// get back form data in case of registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? NULL;
$lastname = $_SESSION['signup-data']['lastname'] ?? NULL;
$username = $_SESSION['signup-data']['username'] ?? NULL;
$password = $_SESSION['signup-data']['password'] ?? NULL;
$cpassword = $_SESSION['signup-data']['cpassword'] ?? NULL;
$email = $_SESSION['signup-data']['email'] ?? NULL;
$userrole = $_SESSION['signup-data']['role'] ?? NULL;

// Delete session data
unset($_SESSION['signup-data']); ;


?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        
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

        <form action="<?= ROOT_URL?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
    
            <input type="text" placeholder="First Name..." name="firstname" value="<?= $firstname ?>">
            <input type="text" placeholder="Last Name..." name="lastname" value="<?= $lastname ?>">
            <input type="text" placeholder="Username..." name="username" value="<?= $username ?>">
            <input type="email" placeholder="Email..." autofill="none" name="email" value="<?= $email ?>">
            <input type="password" placeholder="Create Password..." name="password" value="<?= $password ?>">
            <input type="password" placeholder="Confirm Password..." name="cpassword" value="<?= $cpassword ?>">
            <select name="role"  value="<?= $userrole; ?>" id="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

            <div class="form__control">
                <label for="avatar">Profile Picture</label>
                <input type="file" name="avatar" id="avatar" placeholder="Choose Your Profile Image Name...">
            </div>

            <button type="submit" name="submit" class="btn ">Add User</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> 
<?php 

require_once("partials/footer.php");
?>
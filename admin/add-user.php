<?php 

require_once("partials/header.php");
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <div class="alert__message error">
            <p>This is an success message message</p>
        </div>

        <form action="" enctype="multipart/form-data">
    
            <input type="text" placeholder="First Name...">
            <input type="text" placeholder="Last Name...">
            <input type="text" placeholder="Username...">
            <input type="email" placeholder="Email..." autofill="none">
            <input type="password" placeholder="Create Password...">
            <input type="password" placeholder="Confirm Password...">
            <select name="" id="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

            <div class="form__control">
                <label for="avatar">Profile Picture</label>
                <input type="file" id="avatar" placeholder="Choose Your Profile Image Name...">
            </div>

            <button type="submit" class="btn ">Add User</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> 
<?php 

require_once("partials/footer.php");
?>
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
        
            <select name="" id="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>

    

            <button type="submit" class="btn ">Save Changes</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> -->
<?php 

require_once("partials/footer.php");
?>
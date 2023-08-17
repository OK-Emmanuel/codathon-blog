<?php 

require_once("partials/header.php");
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <div class="alert__message error">
            <p>This is an error message</p>
        </div>

        <form action="">
        
            <input type="text" placeholder="Category title...">
            <textarea rows="4" placeholder="Description"></textarea>
            <button type="submit" class="btn ">Add Category</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> 
<?php 

require_once("../partials/footer.php");
?>
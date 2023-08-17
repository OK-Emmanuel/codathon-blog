<?php 

require_once("partials/header.php");
?>
    <!-- ================================  END OF NAV================ -->


     
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <div class="alert__message error">
            <!-- <p>This is an success message message</p> -->
        </div>

        <form action="" enctype="multipart/form-data">
        
            <input type="text" placeholder="Post title...">
            <select name="" id="">
                <option value="">Coding</option>
                <option value="">AI</option>
            </select>

            <textarea rows="10" placeholder="Body"></textarea>

            <div class="form__control inline">
                <input type="checkbox" id="is_featured" checked>
                <label for="is_featured">Featured</label>
                
            </div>

            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="" id="thumbnail" checked>
                
            </div>

           
            <button type="submit" class="btn ">Update Post</button>
            

        </form>
    </div>
</section>

<!-- !-- ==================== FOOTER ==================== --> -->
<?php 

require_once("partials/footer.php");
?>
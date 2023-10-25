

<?php 
include ('config/database.php');

if(isset($_GET['id'])){
    // get updated form
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // update linked post to uncategorized category
    $update_cat_query = "UPDATE posts SET category_id=5 WHERE category_id = $id";
    $update_cat_result = mysqli_query($connection, $update_cat_query);

    if(!mysqli_errno($connection)){
        // Delete Category now
        $delete_cat_query = "DELETE FROM categories WHERE cat_id = '$id' LIMIT 1";
        $delete_query_result = mysqli_query($connection, $delete_cat_query);
        $_SESSION['success-message'] = "Category Deleted Successfully";
        header("Location: " .ROOT_URL . 'admin/manage-categories.php');
    }





    
}

header('Location: '.ROOT_URL.'admin/manage-categories.php');
die(0);
?>
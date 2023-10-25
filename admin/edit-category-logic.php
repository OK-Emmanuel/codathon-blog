<?php 
include ('config/database.php');

if(isset($_POST['submit'])){
    // get updated form
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 
    // Check for valid input
    if(!$title || !$description){
        $_SESSION['error-message'] = "Invalid form input";
    }else{
        // update user
        $query = "UPDATE categories SET title= '$title', description ='$description' WHERE cat_id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['error-message'] = "Something Went Wrong. Please try again";
        }else{
            $_SESSION['success-message'] = "Category {$title} updated successfully";
        }
    }
}
header('Location: '. ROOT_URL . 'admin/manage-categories.php');
die(0);
?>
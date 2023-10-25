<?php 
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch related post
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // 
    if(mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '..images/' . $thumbnail_name;

        // Delete Associated Image
        if($thumbnail_path){
            unlink($thumbnail_path);

            // delete other post features
            $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_result);

            // Pass success message on completion
            if(!mysqli_errno($connection)){
                $_SESSION['sucess-message'] = "Post Deleted Successfully";
                header("Location:" . ROOT_URL . 'admin/');
            }
        }
    }
}
header("Location:" . ROOT_URL . 'admin/');

?>
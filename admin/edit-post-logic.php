<?php 

require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // Set is_featured (post) to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // validate form data
    if(!$title){
        $_SESSION['error-message'] = "Please Enter Post Title";
    }elseif(!$category_id){
        $_SESSION['error-message'] = "Please Select the Category"; 
    }elseif(!$body){
        $_SESSION['error-message'] = "Your post has no content";
    }else{
        // Delete existing thumbnail if new thumbnail is available
        if($thumbnail['name']){
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }
            
            // Then work on the new image
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;
    
            // make sure the file is an image
            $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
    
            if(in_array($extension, $allowed_files)){
                // check for image size if image extension works fine 
                if($thumbnail['size'] < 2000000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['error-message'] = "File size too big. Image should be less than 2mb";
                }
            }else{
                $_SESSION['error-message'] = "Image type not allowed. Please use PNG, WEBP, JPG or JPEG";
            }
        }
    }
    // redirect back (with form data) when things go wrong
    if($_SESSION['error-message']){
        $_SESSION['add-post-data'] = $_POST;
        header("Location:" . ROOT_URL . "admin/edit-post.php?id={$id}");
        die(0);
    }else{
        // Set is_featured of all post to 0, if this post is featured. (Multiple featured posts are now allowed)
        if($is_featured == 1){
            $defeatured_posts_query = "UPDATE posts SET is_featured = 0";
            $defeatured_result = mysqli_query($connection, $defeatured_posts_query);
        }

        // Set thumbnail name if new image is uploaded else keep old version
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        // Update post into database
        $insert_query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured = $is_featured WHERE id = $id LIMIT 1";        
        $result = mysqli_query($connection, $insert_query);
    }

    if(!mysqli_errno($connection)){
        $_SESSION['success-message'] = "Post Updated Successfully";
        header("Location:" . ROOT_URL . "admin/index.php");
        die(0);
    }

}
   
header("Location:" .ROOT_URL. 'admin/edit-post.php');
die(0);



?>
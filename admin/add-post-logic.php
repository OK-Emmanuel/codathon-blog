<?php 
require 'config/database.php';

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user-id'];
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
    }elseif(!$thumbnail['name']){
        $_SESSION['error-message'] = "Please select an Image for Your Post";
    }else{

        // process the image if all conditions matched
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

    // redirect back (with form data) when things go wrong
    if(isset($_SESSION['error-message'])){
        $_SESSION['add-post-data'] = $_POST;
        header("Location: " . ROOT_URL . 'admin/add-post.php');
        die(0);
    }else{
        // Set is_featured of all post to 0, if this post is featured. (Multiple featured posts are now allowed)
        if($is_featured == 1){
            $defeatured_posts_query = "UPDATE posts SET is_featured = 0";
            $defeatured_result = mysqli_query($connection, $defeatured_posts_query);
        }

        // Insert post into database
        $insert_query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured)
        VALUES ('$title', '$body', '$thumbnail_name', '$category_id', '$author_id', $is_featured)";
        $result = mysqli_query($connection, $insert_query);

        if(!mysqli_errno($connection)){
            $_SESSION['success-message'] = "Post added successfully";
            header('Location: ' . ROOT_URL . 'admin/');
            die(0);
        }
    }
}
 
$_SESSION['error-message'] = "Please Add A New Post";
header('Location: ' . ROOT_URL . 'admin/add-post.php');
die(0);
?>
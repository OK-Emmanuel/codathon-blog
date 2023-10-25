<?php 
include ('config/database.php');

if(isset($_GET['id'])){
    // get updated form
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch user details
    $query = "SELECT * FROM categories WHERE cat_id='$id'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // Limit to one user
    if(mysqli_num_rows($result) == 1){
       $avatar_name = $user['avatar'];
       $avatar_path = '../images/' .$avatar_name;

    //    Delete user profile image
    if($avatar_path){ unlink($avatar_path); }
    }


    // Delete all posts later
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id = $id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if(mysqli_num_rows($thumbnails_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnails_result)){
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];

            // Delete associated images
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }

    // Delete user from DB
    $delete_user_query = "DELETE FROM users WHERE user_id = '$id' ";
    $delete_query_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)){
        $_SESSION['error-message'] = "Something went wrong, couldn't delete {$user['username']}";
    } else {
        $_SESSION['success-message'] = "User Deleted Successfully";
    }


 

}

header('Location: '.ROOT_URL.'admin/manage-users.php');
die(0);
?>
<?php 
include ('config/database.php');

if(isset($_POST['submit'])){
    // get updated form
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);

    // Check for valid input
    if(!$firstname || !$lastname){
        $_SESSION['error-message'] = "Invalid form input";
    }else{
        // update user
        $query = "UPDATE users SET firstname= '$firstname', lastname='$lastname', is_admin = $is_admin WHERE user_id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['error-message'] = "Something Went Wrong. Please try again";
        }else{
            $_SESSION['success-message'] = "User {$username} updated successfully";
        }
    }
}
header('Location: '. ROOT_URL . 'admin/manage-users.php');
die(0);
?>
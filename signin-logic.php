<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    // get form data
    $username = filter_var($_POST['username'],  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username){
        $_SESSION['signin'] = "Username of Email required";
    }elseif (!$password){
        $_SESSION['signin'] = "Password Required";
    } else{
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username  = '$username'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);


        if(mysqli_num_rows($fetch_user_result) == 1){
            // Convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            // Compare the password;
            if(password_verify($password, $db_password)){
                // Set session for access control
                $_SESSION['user-id'] = $user_record['user_id'];

                // Set session for admin
                if($user_record['is_admin'] == 1){
                    $_SESSION['user_is_admin'] = true;
                } 

                // Log user in
                header('Location: ' . ROOT_URL . 'admin/');
            }else{
                $_SESSION['signin-error'] = "Please check your input";
                header('Location:'.ROOT_URL .'signin.php');
                die();
            } 

            }else{
                $_SESSION['signin-error'] = "User not found. Please create an account";
                header('Location: ' . ROOT_URL . 'signin.php');
                die();

        }
    }

    // If any problem, redircect to signin
    if(isset($_SESSION['signin-error'])){
        $_SESSION['signin-data'] = $_POST;
        header('Location: '. ROOT_URL . 'signin.php');
    }
} else {
    header('Location: '. ROOT_URL . 'signin.php');
    die();
}
?>
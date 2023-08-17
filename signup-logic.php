<?php 
require 'config/database.php';

if(isset($_POST['submit'])){
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cpassword = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$avatar = $_FILES['avatar'];


//validate input values
if(!$firstname){
    $_SESSION['signup-error'] = "Please enter Your First name";
} elseif(!$lastname){
    $_SESSION['signup-error'] = "Please enter Your Last name";
} elseif(!$username){
    $_SESSION['signup-error'] = "Please enter Your Username";
} elseif(!$email){
    $_SESSION['signup-error'] = "Please enter Your Email";
} elseif(!$avatar['name']){
    $_SESSION['signup-error'] = "Please fill in Your profile image";
} else {
    if(strlen($password !== $cpassword)){
    $_SESSION['signup-error'] = "Password and confirm passwords do not match";
    } else{
        // hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // check if user exists
        $user_check_query = "SELECT * FROM users WHERE
        username = '$username' OR email = '$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);
        if(mysqli_num_rows($user_check_result)){
            $_SESSION['signup-error'] = "Username or email already used. Please sign in to your account" ;

        }else{
            // Process the image
            // rename image to  make image unique
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = 'images/' . $avatar_name;

            // image extension validation
            $allowed_files = ['png', 'jpg','jpeg', 'webp', 'avif'];
            $extension = explode('.', $avatar_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                //then check image size
                if($avatar['size'] <= 2000000){
                    // upload avatar
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                }else{
                    $_SESSION['signup-error'] = 'File size too big. Image should be less than 2mb';
                }
            } else{
                $_SESSION['signup-error'] = 'File should be either PNG, JPG, JPEG, WEBP or AVIF';

            }
        }
    }
}
// redirect back to signup page in the case of any errors
if (isset($_SESSION['signup-error'])) {
    // pass form data back to signup page
    $_SESSION['signup-data'] = $_POST;
    header("location: " . ROOT_URL . 'signup.php');
    die();
}else{
    // insert new user into database
    $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin)
    VALUES('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', '0')";
    $insert_user_result = mysqli_query($connection, $insert_user_query);
    if(!mysqli_errno($connection)){
        // redirect to login page with success message
        $_SESSION['signin-success'] = "Registration Successful. Please log in";
        header("location: " . ROOT_URL . 'signin.php');
        die();
    }
}

} else{
    // return unregistered user to this signup
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}


?>
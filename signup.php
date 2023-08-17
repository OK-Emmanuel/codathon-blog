<?php 
include 'config/database.php';


// get back form data in case of registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? NULL;
$lastname = $_SESSION['signup-data']['lastname'] ?? NULL;
$username = $_SESSION['signup-data']['username'] ?? NULL;
$password = $_SESSION['signup-data']['password'] ?? NULL;
$cpassword = $_SESSION['signup-data']['cpassword'] ?? NULL;
$email = $_SESSION['signup-data']['email'] ?? NULL;
unset($_SESSION['signup-data']); ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code-a-thon Blog Website</title>
    <!-- Iconscout cdn link -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,500;0,600;0,800;0,900;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT_URL ?>styles/styles.css">

</head>
<body>
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>

        <?php if(isset($_SESSION['signup-error'])): ?>
        <div class="alert__message error">
            <p><?= $_SESSION['signup-error']; ?> </p>
            <?php unset($_SESSION['signup-error']); ?>
        </div>
       <?php endif; ?>

        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" placeholder="First Name..." value="<?= $firstname ?>">
            <input type="text" name="lastname" placeholder="Last Name..." value="<?= $lastname ?>">
            <input type="text" name="username" placeholder="Username..." value="<?= $username ?>">
            <input type="email" name="email" placeholder="Email..." autofill="none" value="<?= $email ?>">
            <input type="password" name="password" placeholder="Create Password..." value="<?= $password ?>">
            <input type="password" name="cpassword" placeholder="Confirm Password..." value="<?= $cpassword ?>">
            <div class="form__control">
                <label for="avatar" >Profile Picture</label>
                <input type="file" name="avatar" id="avatar" placeholder="Choose Your Profile Image Name...">
            </div>
            <button type="submit" name="submit" class="btn ">Sign Up</button>
            <small>Already have an account? <a href="singin.php">Sign In </a></small>

        </form>
    </div>
</section>
</body>
</html>
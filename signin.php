<?php 
require("config/database.php");

// get back form data in case of registration error
$username = $_SESSION['signin-data']['username'] ?? NULL;
$password = $_SESSION['signin-data']['password'] ?? NULL;
unset($_SESSION['signin-data']); ;
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
    <link rel="stylesheet" href="styles/styles.css">

</head>
<body>
    <section class="form__section">
    <div class="container form__section-container">
        <h2>Sign In</h2>
            
            <!-- alert success message -->
        <?php if(isset($_SESSION['signin-success'])): ?>
        <div class="alert__message success">
            <p><?= $_SESSION['signin-success']; ?> </p>
            <?php unset($_SESSION['signin-success']); ?>
        </div>

            <!-- Alert Error Message -->
       <?php elseif(isset($_SESSION['signin-error'])):?>
        <div class="alert__message error">
            <p><?= $_SESSION['signin-error']; ?> </p>
            <?php unset($_SESSION['signin-error']); ?>
        </div>
       <?php endif; ?>

        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
        
            <input type="text" placeholder="Username..." name="username" value="<?= $username; ?>">
            <input type="password" placeholder="Create Password..." name="password" value="<?= $password; ?>">
            
            <button type="submit" name="submit" class="btn ">Sign In</button>
            <small>Don't have an account? <a href="signup.php">Sign Up </a></small>

        </form>
    </div>
</section>
</body>
</html>
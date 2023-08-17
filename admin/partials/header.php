<?php 
require 'config/database.php';

if(!isset($_SESSION['user-id'])){
    header("Location:" . ROOT_URL . 'signin.php');
    die(0);
}
    else{

        // Fetch current user

        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT avatar FROM users WHERE user_id='$id'";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
}
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
    <link rel="stylesheet" href="../styles/styles.css">

</head>
<body>
    <nav>
        <div class="container nav__container">
            <a href="index.php" class="nav__logo">CODATHON</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar']; ?>" alt="">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                    </ul>
                </li>   
                <?php else: ?>  
                <li><a href="<?= ROOT_URL ?>signin.php">Sign in</a></li>
                 <?php endif; ?>         
            </ul>

            <!-- Hamburger for mobiles -->
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!-- ================================  END OF NAV================ -->
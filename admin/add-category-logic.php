<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['error-message'] = "Please fill in the title";
    }elseif(!$description){
        $_SESSION['error-message'] = "Please fill in the description";
    }

    if(isset($_SESSION['error-message'])){
        $_SESSION['add-category-data'] = $_POST;
        header("Location: " . ROOT_URL . 'admin/add-category.php');
    }else{
        // insert into categories
        $query = "INSERT INTO categories (title, description)
        VALUES('$title', '$description') ";
        $result = mysqli_query($connection, $query);
        if(mysqli_errno($connection)){
            $_SESSION['error-message'] = 'Something went wrong';
            header("Location: " . ROOT_URL . 'admin/add-category.php');
            die(0);
        }else{
            $_SESSION['success-message'] = "Category {$title} added successfully";
            header("Location: " . ROOT_URL . "admin/manage-categories.php");
        }
    }
}
?>
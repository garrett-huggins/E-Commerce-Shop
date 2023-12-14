<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slanted Tech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
</head>
<body class="bg-light">

<div id="page-container">
    <div class="bg-white" id="header-container">
        <div id="header" class="d-flex container align-items-center justify-content-between">
            <a href="/ecommerce_project/" class="text-black" style="text-decoration: none;"><h1>Slanted Tech</h1></a>
            
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                // If logged in, display the view cart, order history, and logout buttons
                echo '<div>';
                echo '<a class="btn btn-primary me-2" href="view_cart.php">View Cart</a>';
                echo '<a class="btn btn-info me-2" href="order_history.php">Order History</a>';
                echo '<a class="btn btn-danger" href="logout.php" role="button">Logout</a>';
                echo '</div>';
            } else {
                // If not logged in, display the login and register buttons
                echo '<div>';
                echo '<a class="btn btn-primary me-2" href="login.php" role="button">Login</a>';
                echo '<a class="btn btn-secondary" href="register.php" role="button">Register</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="container">

<?php
session_start();
include 'config.php';

// redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user id
$user_id = $_SESSION['user_id'];

// Get product ID and quantity from the request
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Check if the product is already in the cart for this user
$check_query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
$check_result = $mysqli->query($check_query);

if ($check_result->num_rows > 0) {
    // Update quantity if the product is already in the cart
    $update_query = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
    $mysqli->query($update_query);
} else {
    // Insert new item into the cart
    $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
    $mysqli->query($insert_query);
}

// Redirect back to the product page or wherever you want
header("Location: products.php");
exit();
?>

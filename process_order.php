<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve user and cart information
$user_id = $_SESSION['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];

$cart_query = "SELECT p.id, p.name, p.price, c.quantity FROM cart c
               JOIN products p ON c.product_id = p.id
               WHERE c.user_id = $user_id";
$cart_result = $mysqli->query($cart_query);


// Insert order into the orders table with user information
$order_query = "INSERT INTO orders (user_id, first_name, last_name, address) 
                VALUES ($user_id, '$first_name', '$last_name', '$address')";
$mysqli->query($order_query);

// Retrieve the order ID of the newly inserted order
$order_id = $mysqli->insert_id;

// Move cart items to order_items table and link them to the order
$move_cart_query = "INSERT INTO order_items (order_id, product_id, quantity)
                   SELECT $order_id, product_id, quantity FROM cart WHERE user_id = $user_id";
$mysqli->query($move_cart_query);

// Clear the user's cart after the order is processed
$clear_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
$mysqli->query($clear_cart_query);

$mysqli->close();

// Redirect to order history page
header("Location: order_history.php");
exit();
?>
